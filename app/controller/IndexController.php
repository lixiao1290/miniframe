<?php
namespace app\controller;

use app\view\page;
use minicore\config\ConfigBase;
use minicore\model\Model;

class IndexController
{

    public function __construct()
    {}
    public  function index()
    {
        $data=new Model();
        $data->table='mi';
        return array('data'=>$data) ;
    }
}

