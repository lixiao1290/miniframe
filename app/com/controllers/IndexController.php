<?php
namespace app\com\controllers;



use minicore\lib\ControllerBase;

class IndexController extends ControllerBase
{

    public function initial()
    {
         $this->assign('menu', array('首页','会员管理'));
    }
    public  function index()
    {
        echo 'hello module';
    }
}

