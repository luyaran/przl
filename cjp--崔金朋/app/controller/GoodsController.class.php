<?php
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class GoodsController extends Controller
{
    public function goods()
    {
        $this->display();
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
    public function index()
    {
        $url = header("location: http://localhost/pr/index.php?c=Goods&a=lists");
        var_dump($url);
    }
}