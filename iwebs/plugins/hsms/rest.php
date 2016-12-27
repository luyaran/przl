<?php
/**
 * @copyright (c) 2015 aircheng.com
 * @file haiyan.php
 * @brief **短信发送接口
 * @author nswe
 * @date 2015/5/30 15:29:38
 * @version 3.3
 */

/**
 * @class haiyan
 * @brief 短信发送接口 http://www.duanxin10086.com/logins.html
 */
class rest extends hsmsBase
{
//    private $submitUrl = "http://www.duanxin10086.com/sms.aspx?action=send";

    private $AccountSid;
    private $AccountToken;
    private $AppId;
    private $ServerIP;
    private $ServerPort;
    private $SoftVersion;
    private $Batch;  //时间戳
    private $BodyType = "xml";//包体格式，可填值：json 、xml
    private $enabeLog = true; //日志开关。可填值：true、
    private $Filename="./log.txt"; //日志文件
    private $Handle;
    function __construct()
    {
        $siteConfigObj = new Config("site_config");
        $site_config   = $siteConfigObj->getInfo();
        $this->Batch = date("YmdHis");
        $this->ServerIP = 'app.cloopen.com';
        $this->ServerPort = '8883';
        $this->SoftVersion = '2013-12-26';
        $this->AccountSid = $site_config['sms_userid'];
        $this->AccountToken = $site_config['sms_username'];
        $this->AppId = $site_config['sms_pwd'];
        $this->Handle = fopen($this->Filename, 'a');
    }

    /**
     * 设置主帐号
     *
     * @param AccountSid 主帐号
     * @param AccountToken 主帐号Token
     */
    function setAccount($AccountSid,$AccountToken){
        $this->AccountSid = $AccountSid;
        $this->AccountToken =  $AccountToken;
    }


    /**
     * 设置应用ID
     *
     * @param AppId 应用ID
     */
    function setAppId($AppId){
        $this->AppId = $AppId;
    }

    /**
     * 打印日志
     *
     * @param log 日志内容
     */
    function showlog($log){
        if($this->enabeLog){
            fwrite($this->Handle,$log."\n");
        }
    }

    /**
     * 发起HTTPS请求
     */
    function curl_post($url,$data,$header,$post=1)
    {
        //初始化curl
        $ch = curl_init();
        //参数设置
        $res= curl_setopt ($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, $post);
        if($post)
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        $result = curl_exec ($ch);
        //连接失败
        if($result == FALSE){
            if($this->BodyType=='json'){
                $result = "{\"statusCode\":\"172001\",\"statusMsg\":\"网络错误\"}";
            } else {
                $result = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><Response><statusCode>172001</statusCode><statusMsg>网络错误</statusMsg></Response>";
            }
        }

        curl_close($ch);
        return $result;
    }



    /**
     * @brief 获取config用户配置
     * @return array
     */
    private function getConfig()
    {
        //如果后台没有设置的话，这里手动配置也可以
        $siteConfigObj = new Config("site_config");

        return array(
            'userid'   => $siteConfigObj->sms_userid,
            'username' => $siteConfigObj->sms_username,
            'userpwd'  => $siteConfigObj->sms_pwd,
        );
    }

    /**
     * @brief 发送短信
     * @param string $mobile
     * @param string $content
     * @return
     */
    public function send($mobile,$content)
    {
//        $log = new log();
//        $log->write('sms',array('begin'));
        $to = $mobile;
        $datas = $content;
        $tempId = 1;
        //主帐号鉴权信息验证，对必选参数进行判空。
        $auth=$this->accAuth();
        if($auth!=""){
            return $auth;
        }
        // 拼接请求包体
        if($this->BodyType=="json"){
            $data="";
            for($i=0;$i<count($datas);$i++){
                $data = $data. "'".$datas[$i]."',";
            }
            $body= "{'to':'$to','templateId':'$tempId','appId':'$this->AppId','datas':[".$data."]}";
        }else{
            $data="";
            for($i=0;$i<count($datas);$i++){
                $data = $data. "<data>".$datas[$i]."</data>";
            }
            $body="<TemplateSMS>
                    <to>$to</to>
                    <appId>$this->AppId</appId>
                    <templateId>$tempId</templateId>
                    <datas>".$data."</datas>
                  </TemplateSMS>";
        }
        $this->showlog("request body = ".$body);
        // 大写的sig参数
        $sig =  strtoupper(md5($this->AccountSid . $this->AccountToken . $this->Batch));
        // 生成请求URL
        $url="https://$this->ServerIP:$this->ServerPort/$this->SoftVersion/Accounts/$this->AccountSid/SMS/TemplateSMS?sig=$sig";
        $this->showlog("request url = ".$url);
        // 生成授权：主帐户Id + 英文冒号 + 时间戳。
        $authen = base64_encode($this->AccountSid . ":" . $this->Batch);
        // 生成包头
        $header = array("Accept:application/$this->BodyType","Content-Type:application/$this->BodyType;charset=utf-8","Authorization:$authen");
        // 发送请求
        $result = $this->curl_post($url,$body,$header);
        $this->showlog("response body = ".$result);
        if($this->BodyType=="json"){//JSON格式
            $datas=json_decode($result);
        }else{ //xml格式
            $datas = simplexml_load_string(trim($result," \t\n\r"));
        }
        //  if($datas == FALSE){
//            $datas = new stdClass();
//            $datas->statusCode = '172003';
//            $datas->statusMsg = '返回包体错误';
//        }
        //重新装填数据
        if($datas->statusCode==0){
            if($this->BodyType=="json"){
                $datas->TemplateSMS =$datas->templateSMS;
                unset($datas->templateSMS);
            }
        }
//        $log->write('sms',array(var_export( $datas,1 )));
        return $this->response($datas);
    }

    /**
     * @brief 解析结果
     * @param $result 发送结果
     * @return string success or fail
     */
    public function response($result)
    {
        if($result->statusCode==0)
        {
            return 'success';
        }
        else
        {
            return 'fail';
        }
    }

    /**
     * @brief 配置文件
     */
    public function getParam()
    {
        return array(
            "sms_userid"   => "商户ID",
            "sms_username" => "用户名",
            "sms_pwd"      => "密码",
        );
    }
    /**
     * 主帐号鉴权
     */
    function accAuth()
    {
        if($this->ServerIP==""){
            $data = new stdClass();
            $data->statusCode = '172004';
            $data->statusMsg = 'IP为空';
            return $data;
        }
        if($this->ServerPort<=0){
            $data = new stdClass();
            $data->statusCode = '172005';
            $data->statusMsg = '端口错误（小于等于0）';
            return $data;
        }
        if($this->SoftVersion==""){
            $data = new stdClass();
            $data->statusCode = '172013';
            $data->statusMsg = '版本号为空';
            return $data;
        }
        if($this->AccountSid==""){
            $data = new stdClass();
            $data->statusCode = '172006';
            $data->statusMsg = '主帐号为空';
            return $data;
        }
        if($this->AccountToken==""){
            $data = new stdClass();
            $data->statusCode = '172007';
            $data->statusMsg = '主帐号令牌为空';
            return $data;
        }
        if($this->AppId==""){
            $data = new stdClass();
            $data->statusCode = '172012';
            $data->statusMsg = '应用ID为空';
            return $data;
        }
    }
}