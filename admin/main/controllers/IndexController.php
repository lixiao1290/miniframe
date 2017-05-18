<?php

namespace admin\main\controllers;

use minicore\helper\Db;
use minicore\lib\ControllerBase;
use minicore\helper\DbContainer;
use FFMpeg\FFMpeg;
use minicore\model\minidemo;
use minicore\config\Configer;
use minicore\lib\Mini;

class IndexController extends ControllerBase
{

    public function initial()
    {
        // $this->assign('menu', array('首页','会员管理'));
    }

    public function index()
    {
        var_dump($_GET);

        $data = [
            'username' => 'lixiao',
            'hobby' => 'music,wine'
        ];
        $dsn = 'mysql:dbname=mini;host=localhost';
        /* $list = Db::database('mini')->table('sys_user')
             ->where(array(
             'id',
             '=',
             7
         ))
             ->asObj()
             ->select();
         $list2 = Db::database('mini')->table('sys_user')
             ->where(array(
             'id',
             '=',
             7
         ))
             ->update(array(
             'username' => 'iegj',
             'sex' => 1
         ));

         var_dump($list);*/
        // Db::database('mini')->getPdo()->beginTransaction();
        $this->assign('list', [
            '张武',
            '李宵',
            '徐瑶瑶',
            '张彪',
            '王世超'
        ]);
        $this->registerJs(array(
            'a',
            'b',
            'c'
        ));
        $this->registerCss(array(
            'd'
        ));


        // var_dump($_SERVER['HTTP_USER_AGENT']);
        /*
         * $useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
         * if(strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false ){
         * echo " 非微信浏览器禁止访问";
         * }else{
         * echo "微信浏览器允许访问";
         * }
         */
        $this->view();
    }

    public function ffmpeg()
    {
        $ffpeg = FFMpeg::create([
            'ffmpeg.binaries' => 'E:\ffpeg/ffmpeg.exe',
            'ffprobe.binaries' => 'E:\ffpeg/ffprobe.exe'
        ]);

        $video = $ffpeg->open('QQ20170123-151825-HD.mp4');
        $frame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(2));
        $frame->save('image.jpg');
    }

    public function wx()
    {
        $useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
        if (strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false) {
            exit(" 非微信浏览器禁止访问");
        }
    }

    public function refs()
    {
        $reflect = new \ReflectionClass(minidemo::class);
        var_dump($reflect->getConstructor()->getParameters()[0]->getName());
    }

    public function session()
    {
        //session_start();
        Mini::$app->appPath;
        $sss = 5643223424;
        $_SESSION['session'] = 'ijgjaea3256233jklfak6324lkjkjkl253643kljdafdafdskj543426734456ljlka';
        var_dump(session_get_cookie_params(), session_id(), session_save_path());
        var_dump($_SESSION, get_defined_vars());
    }

    public function mails()
    {
        echo 'mail tests ！';


        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance('smtp.163.com')
            ->setUsername('aizhizhiren@163.com')
            ->setPassword('lx0521131')
        ;

        /*
        You could alternatively use a different transport such as Sendmail or Mail:

        // Sendmail
        $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

        // Mail
        $transport = Swift_MailTransport::newInstance();
        */

// Create the Mailer using your created Transport
        $mailer = \Swift_Mailer::newInstance($transport);

// Create a message
        $message = \Swift_Message::newInstance('Hello lixiao')
            ->setFrom(array('aizhizhiren@163.com' => 'li'))
            ->setTo(array('209201763@qq.com'))
            ->setBody('Hello lixiao')
        ;

// Send the message
        $result = $mailer->send($message);
    }

    public function tick()
    {
        declare(ticks=1) {
            // entire script here
            echo 12;
        }

// or you can use this:
        declare(ticks=1);
        for ($i=0;$i<10;$i++){
            $a = 1;


        }
    }
}

