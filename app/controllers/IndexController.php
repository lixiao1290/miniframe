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
        
        echo '<p>hello friend</p>';
        self::view();
    }
}

