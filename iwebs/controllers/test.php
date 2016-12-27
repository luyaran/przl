<?php
header("content-type:text/html;charset=utf-8");
class Test extends IController
{
    public $checkRight  = array('check' => 'all','uncheck' => array('default','admin_repwd','admin_repwd_act','navigation','navigation_update','navigation_del','navigation_edit','navigation_recycle','navigation_recycle_del','navigation_recycle_restore'));
    public $layout      = 'admin';

    public function init()
    {
        IInterceptor::reg('CheckRights@onCreateAction');
    }

    //展示添加页面
    public function hello()
    {
//        $siteConfigObj = new Config("site_config");
//        $site_config   = $siteConfigObj->getInfo();
//        $index_slide = isset($site_config['index_slide'])? unserialize($site_config['index_slide']) :array();
//        var_dump($site_config);die;
//        echo "欢迎使用Iweb框架。";
       /* $testObj = new IModel("member");
        $arr = $testObj->query();
        $time=$arr[0]['time'];
        $x=time($time);
        echo $x."&nbsp;&nbsp;&nbsp;";
        echo time(date('Y-m-d H:i:s'));*/
        $this->redirect('hello');
    }

    //确定添加
    public function adds()
    {
        $name = IFilter::act(IReq::get("name"));
        $sex = IFilter::act(IReq::get("sex"));
        $testObj = new IModel("test");
        $arr=array("name"=>$name,"sex"=>$sex);
        $testObj->setData($arr);
        $testObj->add();
        //echo $name.",".$sex;
        $this->redirect('show');
    }

    //展示数据
    public function show()
    {
        $id= IFilter::act(IReq::get("id"));
        $testObj = new IModel("goods");
        $arr = $testObj->query();
//        $arr =array(array('id'=>1));
        $this->list=$arr;
        //var_dump($arr);die;
        $this->redirect('show');
    }

    //删除数据
    public function del()
    {
        $id = IFilter::act(IReq::get("id"));
        $testObj = new IModel("test");
        $testObj->del("id=$id");
        $this->redirect('show');
    }

    //展示修改页面
    public function upd()
    {
        $testObj = new IModel("test");
       // $id = IFilter::act(IReq::get("id"));
        $arr = $testObj->query("id=6");
       // $this->list=$arr;
        var_dump($arr);
       // $this->redirect('upd');
    }

    //确定修改
    public function sureMake()
    {
        $id = IFilter::act(IReq::get("id"));
        $name = IFilter::act(IReq::get("name"));
        $sex = IFilter::act(IReq::get("sex"));
        $testObj = new IModel("test");
        $test = array(
            'id'=>$id,
            'name'=>$name,
            'sex'=>$sex
        );
        $testObj->setData($test);
        $where = "id=".$id;
        $testObj->update($where);
        $this->redirect('show');
    }
    public function user_list()
    {
        $this->redirect('user_list');
    }
    public function upfile(){

        if(isset($_FILES['image'])){

            $image = $_FILES['image'];

            $filename = time().substr($image['name'],strripos($image['name'],'.'));
            //var_dump($image);

            $path = './upload/'.$filename;
            //move_uploaded_file 移动上传过文件 第一个参数 临时文件的名字 ，要新生成的文件的路径和名字
            move_uploaded_file($image['tmp_name'],$path);
            //要把excel 转化成数组
            $e = $this->readExcel($path);
            var_dump($e);

//            $this->redirect('index?filename='.$filename);
        }

//        $this->redirect('index');

    }

    function readExcel($path){
        //引入PHPExcel类库
        include(IWEB_PATH.'core/util/PHPExcel.php');
        include(IWEB_PATH.'core/util/PHPExcel/IOFactory.php');

        $type = 'Excel5';//设置为Excel5代表支持2003或以下版本，Excel2007代表2007版
        $xlsReader = PHPExcel_IOFactory::createReader($type);
        $xlsReader->setReadDataOnly(true);
        $xlsReader->setLoadSheetsOnly(true);
        $Sheets = $xlsReader->load($path);

        //开始读取上传到服务器中的Excel文件，返回一个二维数组
        $dataArray = $Sheets->getSheet(0)->toArray();
//        var_dump($dataArray);die;
        return $dataArray;
    }

    public function getimage($filename){

    }

    public function test_report(){
        include(IWEB_PATH.'core/util/PHPExcel.php');
        include(IWEB_PATH.'core/util/PHPExcel/IOFactory.php');

        $objPHPExcel = new PHPExcel();

        /*以下是一些设置 ，什么作者  标题啊之类的*/
        $objPHPExcel->getProperties()->setCreator("转弯的阳光")
            ->setLastModifiedBy("转弯的阳光")
            ->setTitle("数据EXCEL导出")
            ->setSubject("数据EXCEL导出")
            ->setDescription("备份数据")
            ->setKeywords("excel")
            ->setCategory("result file");
        //测试数据
        $data =array(
            array('uid' => 1,'email' => '123@123.com','password'=>'123456'),
            array('uid' => 2,'email' => '456@123.com','password'=>'123456'),
            array('uid' => 3,'email' => '789@123.com','password'=>'123456')
        );
        /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
        foreach($data as $k => $v){

            $num=$k+1;
            $objPHPExcel->setActiveSheetIndex(0)

                //Excel的第A列，uid是你查出数组的键值，下面以此类推
                ->setCellValue('A'.$num, $v['uid']) //A1 A2
                ->setCellValue('B'.$num, $v['email'])
                ->setCellValue('D'.$num, $v['password']);
        }

        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.time().'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }



    function _readExcel($path){
        //引入PHPExcel类库
        include(IWEB_PATH.'core/util/PHPExcel.php');
        include(IWEB_PATH.'core/util/PHPExcel/IOFactory.php');
        include(IWEB_PATH.'core/util/PHPExcel/Reader/Excel5.php');


        $type = 'Excel5';//设置为Excel5代表支持2003或以下版本，Excel2007代表2007版
        $xlsReader = PHPExcel_IOFactory::createReader($type);
        $xlsReader->setReadDataOnly(true);
        $xlsReader->setLoadSheetsOnly(true);
        $Sheets = $xlsReader->load($path);
        //开始读取上传到服务器中的Excel文件，返回一个二维数组
        $dataArray = $Sheets->getSheet(0)->toArray();
        return $dataArray;
    }

    public function testExcel(){
        include(IWEB_PATH.'core/util/PHPExcel.php');
        include(IWEB_PATH.'core/util/PHPExcel/IOFactory.php');

        $excelObj = new PHPExcel();
        var_dump($excelObj);
        //echo 1;
    }
}





?>