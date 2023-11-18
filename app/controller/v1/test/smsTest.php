<?php

require_once(dirname(__FILE__)."/../../../tool/Sms.php");

$fields['uid'] = 'test223ssd';
// $fields['cc'] = '86';
$fields['cc'] = '852';
$fields['phone'] = '51158466';
// $fields['phone'] = '13610081772';

$link = 'https://interactive.thekarllagerfeld.mo/?uid='.$fields['uid'];

$language = 'tc';

$teamplate = array(
    'en'=>'【TKL Macau】

Thank you for registering for THE KARL LAGERFELD Treasure Hunter’s Guide. Start your discovery journey at '.$link.' !

回T退订',
    'sc'=>'【TKL Macau】

感谢您登记澳门卡尔拉格斐奢华酒店大楼寻宝任务指南，请马上点击 '.$link.' 开始您的探索之旅

回T退订',
    'tc'=>'【TKL Macau】

感謝您登記THE KARL LAGERFELD尋寶通行證，請即點擊 '.$link.' 開始您的探索之旅！

回T退订',
);


// $sms_data = new stdClass();

// $sms_data->msg  = $teamplate[$language]; // Dynamics msg for sms, static content need to edit inside model

// $sms = new Sms($fields['cc'],$fields['phone'],$sms_data);

// $sms_result = $sms->sendSMS();

