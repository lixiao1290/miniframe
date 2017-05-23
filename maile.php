<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/22
 * Time: 15:33
 */




$server = "{imap.163.com}"; //邮件服务器
$mailbox = "inbox"; //收件箱
$mailaccount="aizhizhiren@163.com";//用户名
$mailpasswd="lx0521131"; //密码
$stream = @imap_open($server.$mailbox,$mailaccount,$mailpasswd);//打开IMAP 连结
$mail_number = imap_num_msg($stream);//信件的个数
echo $mail_number;
if($mail_number < 1) { echo "No Message for $email"; }//如果信件数为0,显示信息


for($i=$mail_number;$i>=0;$i--)
{
    $headers = @imap_header($stream, $i);
    $mail_header= imap_headerinfo($stream, $i);//邮件头部
    //var_dump ($mail_header);
    $subject = $mail_header->subject;//邮件标题
    $subject=decode_mime($subject);
    echo $subject;


//编码为简体中文的标题的处理方法
// if(stristr($subject, "=?gb2312"))
// {    //编码为简体中文的标题
// $subject=substr($subject,11);
// $subject=substr($subject,0,-2);
// $subject = base64_decode($subject);
// }
    echo $from = $mail_header->fromaddress;//发件人
    echo $date = $mail_header->date;//日期


    $body = imap_fetchbody($stream, $i, 1);
    $body = imap_base64($body);
    $body = nl2br($body);
    echo $body;

//        $body = imap_qprint($body);
//        echo $body;
//        $body = imap_binary($body);
//        $body = imap_base64($body);
    //echo $body;


}


function decode_mime($string)
{
    $pos = strpos($string,'=?');
    if (!is_int($pos)) {
        return $string;
    }
    $preceding = substr($string, 0, $pos); // save any preceding text
    $search = substr($string, $pos+2); /* the mime header spec says this is the longest a single encoded Word can be */
    $d1 = strpos($search, '?');
    if (!is_int($d1)) {
        return $string;
    }
    $charset = substr($string, $pos+2, $d1); //取出字符集的定义部分
    $search = substr($search, $d1+1); //字符集定义以后的部分＝>$search;
    $d2 = strpos($search, '?');
    if (!is_int($d2)) {
        return $string;
    }
    $encoding = substr($search, 0, $d2); ////两个?　之间的部分编码方式　：ｑ　或　ｂ　
    $search = substr($search, $d2+1);
    $end = strpos($search, '?='); //$d2+1 与 $end 之间是编码了　的内容：=> $endcoded_text;
    if (!is_int($end)) {
        return $string;
    }
    $encoded_text = substr($search, 0, $end);
    $rest = substr($string, (strlen($preceding . $charset . $encoding . $encoded_text)+6)); //+6 是前面去掉的　=????=　六个字符
    switch ($encoding) {
        case 'Q':
        case 'q':
//$encoded_text = str_replace('_', '％20', $encoded_text);
//$encoded_text = str_replace('=', '％', $encoded_text);
//$decoded = urldecode($encoded_text);
            $decoded=quoted_printable_decode($encoded_text);
            if (strtolower($charset) == 'windows-1251') {
                $decoded = convert_cyr_string($decoded, 'w', 'k');
            }
            break;
        case 'B':
        case 'b':
            $decoded = base64_decode($encoded_text);
            if (strtolower($charset) == 'windows-1251') {
                $decoded = convert_cyr_string($decoded, 'w', 'k');
            }
            break;
        default:
            $decoded = '=?' . $charset . '?' . $encoding . '?' . $encoded_text . '?=';
            break;
    }
    return $preceding . $decoded .decode_mime($rest);
    //return $preceding . $decoded . $this->decode_mime($rest);

}