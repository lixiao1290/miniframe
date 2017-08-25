<?php

namespace admin\main\controllers;

use admin\tools\Email_reader;
use admin\tools\ReceiveMail;
use minicore\helper\Db;
use minicore\lib\ControllerBase;
use minicore\helper\DbContainer;
use FFMpeg\FFMpeg;
use minicore\model\minidemo;
use minicore\lib\Mini;
use admin\tools\ConvertEncoder;
use Syscover\EmailReader\Server;

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
         /*   '徐瑶瑶',
            '张彪',
            '王世超'*/
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
        var_dump($_GET);
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
            ->setPassword('lx0521131');

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
            ->setBody('Hello lixiao');

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
        for ($i = 0; $i < 10; $i++) {
            $a = 1;


        }
    }

    public function readmails()
    {
        echo 'readmailtest';
        $emailReader = new  Email_reader();
        $i_mails = 0;
        echo '<pre>';
        // print_r($emailReader->getInbox());
        //$body=$emailReader->get(1)['body'];
        // echo $body;
//         print (imap_base64(imap_fetchbody($emailReader->conn,1,2)));
        // print (imap_base64(imap_fetchbody($emailReader->conn,1,'2')));
//        print_r($emailReader->get(1)['header']);
        foreach ($emailReader->getInbox() as $mail_num => $mail) {
            if ($i_mails >= 10) {
                break;
            }
            $structure = get_object_vars($mail['structure']);
            // var_dump(base64_decode($mail['body'],false));
            echo base64_decode(imap_fetchbody($emailReader->conn, $mail['index'], '2'));
            // var_dump($mail);
            $i_mails++;
        }
    }

    public function getmails()
    {


        $hostname = '{imap.163.com:993/imap/ssl}INBOX';
        $username = 'aizhizhiren@163.com';
        $password = 'lx0521131';

        /* try to connect */
        $mail = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

        $total = imap_num_msg($mail);
        echo '一共', $total, '封邮件<br/>';
        for ($n = 1; $n <= $total; $n++) {
            $st = imap_fetchstructure($mail, $n);


            if (!empty($st->parts)) {
                $body = '第'.$n.'封';
                $j = count($st->parts);
                var_dump($st->parts);
                for ($i = 0; $i < $j; $i++) {
                    $part = $st->parts[$i];
                    if ($part->subtype == 'PLAIN') {
                        $body.='part_'.$i;
                        $contents=(imap_fetchbody($mail, $n, $i));
                        $body .= $contents;
                        $mine = imap_fetchmime($mail, $n, $i);
                    }
                }
            } else {
                $body = imap_base64(imap_body($mail, $n));
            }
            $mail_header = imap_headerinfo($mail, $n);
            $subject = $mail_header->subject;//邮件标题
            $subject =  ConvertEncoder::decode_mime ($subject);
            echo ($body), '</pre><br/>';
            echo $subject;

        }


    }

    public function receivemails()
    {
        $hostname = 'imap.163.com';
        $username = 'aizhizhiren@163.com';
        $password = 'lx0521131';
        $fileSavePaht =  '/emailsave/';
        $obj = new ReceiveMail($username, $password, $username,$hostname, 'imap', '993', false);
        $obj->connect();
        $tot = $obj->getTotalMails(); //Total Mails in Inbox Return integer value
        echo "Total Mails:: $tot<br>";

        for ($i = $tot; $i > 0; $i--) {
            $head = $obj->getHeaders($i);  // Get Header Info Return Array Of Headers **Array Keys are (subject,to,toOth,toNameOth,from,fromName)
            echo "Subjects :: " . $head['subject'] . "<br>";
            echo "TO :: " . $head['to'] . "<br>";
            echo "To Other :: " . $head['toOth'] . "<br>";
            echo "ToName Other :: " . $head['toNameOth'] . "<br>";
            echo "From :: " . $head['from'] . "<br>";
            echo "FromName :: " . $head['fromName'] . "<br>";
            echo "<br><br>";
            echo "<br>*******************************************************************************************<BR>";
            echo $obj->getBody($i);  // Get Body Of Mail number Return String Get Mail id in interger
            print_r("附件下载区");
            print_r("<br />");
            $str = $obj->GetAttach($i, $fileSavePaht); // Get attached File from Mail Return name of file in comma separated string  args. (mailid, Path to store file)
            $ar = explode(",", $str);
            foreach ($ar as $key => $value)
                echo ($value == "") ? "" : "Atteched File :: " . $value . "<br>";
            echo "<br>------------------------------------------------------------------------------------------<BR>";
          //  $obj->removeEamil($i); // Delete Mail from Mail box
        }
        $obj->close_mailbox();   //Close Mail Box
    }

    public function reademails()
    {
        $server=new Server('imap.163.com','993','imap');
        $server->setAuthentication('aizhizhiren@163.com','lx0521131');
        $messages=  $server->getMessages(20);
        echo '<pre>  ';
//       print_r($messages);
        echo '<pre>';
        foreach($messages as $message) {
            echo $message->getHtmlBody();
        }
    }
}

