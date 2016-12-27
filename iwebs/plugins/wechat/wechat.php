<?php
/**
 * @copyright (c) 2015 aircheng.com
 * @file wechat.php
 * @brief 微信API接口
 * @date 2015/3/27 21:59:41
 * @version 3.1
 */
class wechat
{
	//微信API地址
	const SERVER_URL = "https://api.weixin.qq.com/cgi-bin";

	//配置数组
	private $config = array(
		'wechat_Token'     => '',
		'wechat_AppID'     => '',
		'wechat_AppSecret' => '',
	);

	//令牌存活时间
	private static $accessTokenTime = 7200;

	//构造函数
	public function __construct()
	{
		//缺少SSL组件
		if(!extension_loaded("OpenSSL"))
		{
			throw new IException("您的环境缺少OpenSSL组件，这是调用微信API所必须的");
		}
		//获取参数配置
		$siteConfigObj = new Config("site_config");
		$this->config['wechat_Token']     = $siteConfigObj->wechat_Token;
		$this->config['wechat_AppID']     = $siteConfigObj->wechat_AppID;
		$this->config['wechat_AppSecret'] = $siteConfigObj->wechat_AppSecret;
	}

	//获取access_token令牌
	public function getAccessToken()
	{
		$cacheObj = new ICache();
		$accessTokenTime = $cacheObj->get('accessTokenTime');

		//延续使用
		if($accessTokenTime && time() - $accessTokenTime < self::$accessTokenTime)
		{
			$accessToken = $cacheObj->get('accessToken');
			if($accessToken)
			{
				return $accessToken;
			}
			else
			{
				$cacheObj->del('accessTokenTime');
				$this->getAccessToken();
			}
		}
		//重新获取令牌
		else
		{
			$urlparam = array(
				'grant_type=client_credential',
				'appid='.$this->config['wechat_AppID'],
				'secret='.$this->config['wechat_AppSecret'],
			);
			$apiUrl = self::SERVER_URL."/token?".join("&",$urlparam);
			$json   = file_get_contents($apiUrl);
			$result = JSON::decode($json);
			if($result && isset($result['access_token']) && isset($result['expires_in']))
			{
				self::$accessTokenTime = $result['expires_in'];
				$cacheObj->set('accessTokenTime',time());
				$cacheObj->set('accessToken',$result['access_token']);
				return $result['access_token'];
			}
			else
			{
				die('令牌获取错误！');
			}
		}
	}

    //处理微信服务器的请求接口
    public function response()
    {
    	$code  = IReq::get('code');
    	$state = IReq::get('state');

    	//oauth回调处理
    	if($code && $state)
    	{
			$result = $this->getOauthAccessToken($code);
			if($result)
			{
				$userData = $this->getUserInfo($result['openid']);
				$this->bindUser($userData);
				$this->login($userData);
			}
			header('location: '.urldecode($state));
    	}
    	else
    	{
			//微信推送处理
	    	if($this->checkSignature())
	    	{
		    	//第一次验证
		    	if($echostr = IReq::get('echostr'))
		    	{
					die($echostr);
		    	}
		    	//相应其他的请求
		    	else
		    	{
		    		$postXML = file_get_contents("php://input");
		    		//微信推送的post数据信息
		    		if($postXML)
		    		{
						$postObj = simplexml_load_string($postXML, 'SimpleXMLElement', LIBXML_NOCDATA);
						//事件推送
						if(isset($postObj->Event))
						{
							switch($postObj->Event)
							{
								//开始订阅
								case "subscribe":
								{

								}
								break;

								//取消订阅
								case "unsubscribe":
								{

								}
								break;

								//网页跳转事件
								case "VIEW":
								{

								}
								break;
							}
						}
						//用户普通消息接收
						else if(isset($postObj->MsgId))
						{
							switch($postObj->MsgType)
							{
								//自动回复
								default:
								{
									$this->textReplay("欢迎光临我们的微商城了解更多商品信息",$postObj);
								}
							}
						}
		    		}
		    	}
		    	die('success');
	    	}
	    	else
	    	{
	    		die('验证失败！');
	    	}
    	}
    }

	/**
	 * @brief 微信文字类型回复
	 * @param object 微信推送过来的数据信息
	 */
    public function textReplay($content,$postObj)
    {
		$replyContent = "<xml><ToUserName><![CDATA[{$postObj->FromUserName}]]></ToUserName><FromUserName><![CDATA[{$postObj->ToUserName}]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[{$content}]]></Content></xml>";
		die($replyContent);
    }

	/**
	 * @brief 提交信息
	 * @param string $submitUrl 提交的URL
	 * @param array $postData 提交数据
	 * @return string 返回的结果字符串
	 */
    public function submit($submitUrl,$postData = null)
    {
		//提交菜单
		$curl = curl_init($submitUrl);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//SSL证书认证
		curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
		curl_setopt($curl,CURLOPT_POST,true); // post传输数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,$postData);// post传输数据
		$responseText = curl_exec($curl);
		curl_close($curl);
		return $responseText;
    }

	/**
	 * 验证推送消息真实性
	 * @return boolean true or false
	 */
	public function checkSignature()
	{
        $signature = IReq::get('signature');
        $timestamp = IReq::get('timestamp');
        $nonce     = IReq::get('nonce');

		$tmpArr = array($this->config['wechat_Token'],$timestamp,$nonce);
		sort($tmpArr,SORT_STRING);
		$tmpStr = sha1(join($tmpArr));

		if($tmpStr == $signature)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * @brief 根据code获取oauth登录令牌和openid
	 * @param string $code
	 */
	private function getOauthAccessToken($code)
	{
		$urlparam = array(
			'appid='.$this->config['wechat_AppID'],
			'secret='.$this->config['wechat_AppSecret'],
			'code='.$code,
			'grant_type=authorization_code',
		);
		$apiUrl = "https://api.weixin.qq.com/sns/oauth2/access_token?".join("&",$urlparam);
		$json   = file_get_contents($apiUrl);
		$result = JSON::decode($json);
		if(!isset($result['openid']))
		{
			throw new IException("根据code值未获取到open_id码");
		}
		return $result;
	}

	/**
	 * 根据openid获取用户信息
	 * @param string $openid 用户openid
	 * @return array用户基本数据
	 */
	public function getUserInfo($openid)
	{
		$accessToken = $this->getAccessToken();
		$urlparam = array(
			'access_token='.$accessToken,
			'openid='.$openid,
		);
		$apiUrl = self::SERVER_URL."/user/info?".join("&",$urlparam);
		$json   = file_get_contents($apiUrl);
		$result = JSON::decode($json);
		return $result;
	}

	/**
	 * @brief 更新菜单
	 * @param json $menuData 菜单数据 {"button":[{"name":"名称","sub_button":[{"type":"view","name":"子菜单名称","url":"http://www.aircheng.com"}]}]}
	 * @return array("errcode" => 0,"errmsg" => "ok")
	 */
	public function setMenu($menuData)
	{
		//URL静默登录替换处理
		$menuData = $this->converOauthUrl($menuData);
		$accessToken = $this->getAccessToken();
		$urlparam = array(
			'access_token='.$accessToken,
		);
		$apiUrl = self::SERVER_URL."/menu/create?".join("&",$urlparam);
		$json   = $this->submit($apiUrl,$menuData);
		$result = JSON::decode($json);
		return $result;
	}

	//URL静默登录替换处理
	private function converOauthUrl($menuData)
	{
		return preg_replace_callback('|(?<="url":").*?(?=")|',array($this,"getOauthUrl"),$menuData);
	}

	/**
	 * @brief 获取自定义菜单
	 * @return array
	 */
	public function getMenu()
	{
		$accessToken = $this->getAccessToken();
		$urlparam = array(
			'access_token='.$accessToken,
		);
		$apiUrl = self::SERVER_URL."/menu/get?".join("&",$urlparam);
		$json   = file_get_contents($apiUrl);
		$result = JSON::decode($json);
		return isset($result['menu']) ? $result['menu'] : null;
	}

	/**
	 * @brief oauth请求code
	 * @param string $url 跳转的URL参数
	 */
	public function getOauthUrl($url)
	{
		if(is_array($url))
		{
			foreach($url as $key => $val)
			{
				return $this->getOauthUrl($val);
			}
		}
		else
		{
			if(strpos($url,"http") === 0)
			{
				return $url;
			}

			$url = IUrl::getHost().IUrl::creatUrl($url);
			$urlparam = array(
				'appid='.$this->config['wechat_AppID'],
				'redirect_uri='.urlencode($this->getOauthCallback()),
				'response_type=code',
				'scope=snsapi_base',
				'state='.urlencode($url),
			);
			$apiUrl = "https://open.weixin.qq.com/connect/oauth2/authorize?".join("&",$urlparam)."#wechat_redirect";
			return $apiUrl;
		}
	}

	//获取oauth登录的回调
	public function getOauthCallback()
	{
		return IUrl::getHost().IUrl::creatUrl("/block/wechat");
	}

	/**
	 * @brief 绑定微信账号到用户系统
	 * @param array $userData array(headimgurl,sex,nickname,openid)
	 */
	private function bindUser($userData)
	{
		//保存openid为其他wechat应用使用
		ISafe::set('wechat_openid',$userData['openid']);

		$tempDB   = new IModel('oauth_user as ou,user as u');
		$oauthRow = $tempDB->getObj("ou.oauth_user_id = '".$userData['openid']."' and ou.oauth_id = 4 and ou.user_id = u.id");

		//用户数据不存在
		if(!$oauthRow)
		{
			$userDB    = new IModel('user');
			$username  = substr($userData['openid'],-8);
	    	$userCount = $userDB->getObj("username = '{$username}' ",'count(*) as num');

	    	//没有重复的用户名
	    	if($userCount['num'] == 0)
	    	{

	    	}
	    	else
	    	{
	    		//随即分配一个用户名
	    		$username = $username.rand(1000,9999);
	    	}

			//插入user表
			$userDB->setData(array(
				'username' => $username,
				'password' => md5(time()),
			));
			$user_id = $userDB->add();

			//插入member表
			$memberDB = new IModel('member');
			$memberDB->setData(array(
				'user_id' => $user_id,
				'sex'     => $userData['sex'],
				'time'    => ITime::getDateTime(),
			));
			$memberDB->add();

			//插入oauth_user关系表
			$oauthUserDB = new IModel('oauth_user');
			$oauthUserDB->del("oauth_user_id = '".$userData['openid']."'");
			$oauthUserData = array(
				'oauth_user_id' => $userData['openid'],
				'oauth_id'      => 4,
				'user_id'       => $user_id,
				'datetime'      => ITime::getDateTime(),
			);
			$oauthUserDB->setData($oauthUserData);
			$oauthUserDB->add();
		}
	}

	/**
	 * @brief 登录用户系统
	 * @param array $userData array(headimgurl,sex,nickname,openid)
	 */
	public function login($userData)
	{
		$oauthUserDB = new IModel('oauth_user');
		$oauthRow = $oauthUserDB->getObj("oauth_user_id = '".$userData['openid']."' and oauth_id = 4");
		$userRow  = array();
		if($oauthRow)
		{
			$userDB = new IModel('user');
			$userRow = $userDB->getObj('id = '.$oauthRow['user_id']);
		}

		if(!$userRow)
		{
			$oauthUserDB->del("oauth_user_id = '".$userData['openid']."' and oauth_id = 4");
			die('无法获取微信用户与商城的绑定信息，请重新关注公众账号');
		}

		$user = CheckRights::isValidUser($userRow['username'],$userRow['password']);
		if($user)
		{
			CheckRights::loginAfter($user);
		}
		else
		{
			die('<h1>该用户'.$userRow['username'].'被移至回收站内无法进行登录</h1>');
		}
	}
}