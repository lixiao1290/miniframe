<?php
namespace app\controllers;

use app\view\page;
use minicore\config\ConfigBase;
use minicore\model\Model;
use minicore\lib\ControllerBase;

class IndexController extends ControllerBase
{

    public function __construct()
    {}
    public  function index()
    {
        $this->assign('suc', 'success!');
        $this->assign('list', ['张武','李宵','齐名浩','徐瑶瑶','张彪','王世超','']);
        $this->view();
    }
}

