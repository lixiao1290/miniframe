<?php
return [
    //微信接入
    'wechat'=>[
        'token'=>'601E6934626498B4',
        'appid'=>'wxd325cba7b6ce2a36',
        'secret'=>'fbe0efe9ec8bb4e2cce165113532fc86'
    ],
     'token_url' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential',
     'kf_url' => 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=',
    'jgsms_url' => 'http://60.215.129.7:9080/jnydsms/SendSms?'
        .'username=jnyd&password=10658531@2017'
        .'&method=userMt',
    'phone_url' => 'http://apis.juhe.cn/mobile/get?key=305261b74cfab3b28e95adeecc7b9e97&phone=',

];
