<?php
namespace app\main\controllers;

use minicore\helper\Db; 
use minicore\lib\ControllerBase;


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
        //$db=Db::instance(array('user'=>'root','pwd'=>'root'))->db('mini');
        $t=file_get_contents('F:\num.txt');
        $t++;
        file_put_contents('F:\num.txt', $t);
        
        
       // $db=Db::instance(array('user'=>'root','pwd'=>'root'))->db('mini')->field(array('username','email'))->table('sys_users')->insert($data);
        $dsn = 'mysql:dbname=mini;host=localhost';
         // var_dump('<pre>',Db::db('mini')->table('sys_user')->select('*'));
        //var_dump('<pre>',Db::instance());
        $pdo=new \PDO($dsn,'root','root');
      /*   $stat=$pdo->prepare('insert into sys_users(username,hobby)values(:username,:hobby)');
        $stat->execute($data);
       */ 
       // var_dump('<pre>',Db::instance());
        //var_dump($stat->debugDumpParams());
        
        Db::database('mini')->table('sys_user')->where(array('id','=',2))->getWherePar();
        
        
//         $a=range('a', 'n');
//         $b=range('o','z');
//         $c=array_merge($a,$b);
//         var_dump('<pre>',$c);
        
        
        
        
        $this->assign('suc', 'success!');
        $this->assign('list', ['张武','李宵','徐瑶瑶','张彪','王世超','']);
        $this->registerJs(array('a','b','c'));
        $this->registerCss(array('d',));
          
        $this->view();
    }
}

