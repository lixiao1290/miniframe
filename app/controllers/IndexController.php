<?php
namespace app\controllers;

use app\view\page;
use minicore\config\ConfigBase;
use minicore\model\Model;
use minicore\lib\ControllerBase;
use minicore\lib\Mini;

class IndexController extends ControllerBase
{

    public function initial()
    {
         $this->assign('menu', array('首页','会员管理'));
    }
    public  function index()
    {
        $this->assign('suc', 'success!');
        $this->assign('list', ['张武','李宵','齐名浩','徐瑶瑶','张彪','王世超','']);
        $this->registerJs(array('a','b','c'));
        $this->registerCss(array('d',));
          
        $this->view();
    }
}

