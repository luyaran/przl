<?php
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class TestController extends Controller
{
    public function index()
    {
        $data = mover($_POST);
        if($data){
            $res = D("User")->adds($data);
            if($res){
                $arr = D("User")->select();
                foreach($arr as $key=>$val){
                    $arr[$key] = "<tr><td>".$val['id']."</td><td>".H($val['name'])."</td><td>".H($val['sex'])."</td><td>".H($val['hobby'])."</td><td>".H($val['content'])."</tr></td>";
                }
                echo json_encode($arr);
            }else{
                echo 0;
            }
        }else{
            $this->display();
        }
    }
    public function goods()
    {
        $arr = array(1=>array("id"=>"1","name"=>"cuijinpeng"),2=>array("id"=>"2","name"=>"luyaran"));
        foreach($arr as $key=>$val){
            $arr[$key] = "<table border='1' align='center'><tr><td>".$val['id']."</td><td>".$val['name']."</td></tr></table>";
        }
        var_dump($arr);die;
    }
    public function adds()
    {
        $data = mover($_POST);
        $res = $this->db->add("login",$data);
        if($res){
            $this->render("Goods","lists");
        }
    }
    public function lists()
    {
        $li = D("Goods")->select();
        $length = count($li);
        $size = 2;
        $page = P($length,$size)->show();
        $pages = isset($_GET['p']) ? $_GET['p'] : 1;
        $offset = ($pages - 1) * $size;
        $list = D("Goods")->makePage($offset,$size);
        $this->assign('page',$page);
        $this->assign('arr',$list);
        $this->display();
    }

}