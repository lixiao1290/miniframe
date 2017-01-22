<?php
namespace app\main\controllers;

use minicore\helper\Db; 
use minicore\lib\ControllerBase;
use minicore\helper\DbContainer;


class IndexController extends ControllerBase
{

    public function initial()
    {
        // $this->assign('menu', array('首页','会员管理'));
    }
    public  function index()
    {
        var_dump($_GET);
        $data=['username'=>'lixiao','hobby'=>'music,wine'];
        $t=file_get_contents('F:/num.txt');
        $t++;
        file_put_contents('F:/num.txt', $t);
        $dsn = 'mysql:dbname=mini;host=localhost';
        $db=Db::database('mini')->table('sys_user')->where(array('id','=',7))->asObj()->select();
       // Db::database('mini')->getPdo()->beginTransaction();
        var_dump($db);
        $this->assign('list', ['张武','李宵','徐瑶瑶','张彪','王世超']);
        $this->registerJs(array('a','b','c'));
        $this->registerCss(array('d',));
          
        $this->view();
    }
}

