<?php
// header("Access-Control-Allow-Origin:*");
// header("Access-Control-Allow-Headers:*"); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Asia/Hong_Kong');
    require_once(dirname(__FILE__)."/../../../services/User.php");
    require_once(dirname(__FILE__)."/../../../services/Count.php");
    require_once(dirname(__FILE__)."/../../../services/Entry.php");

    $data = json_decode(file_get_contents("php://input"),true);

    $fields['user_group'] = $data['user_group'];
    $fields['phone'] = $data['phone'];

    $language = $data['language'];

    require_once(dirname(__FILE__)."/../../../tool/Validation.php");

    $vaild = new Validation();
    $vaildPhone = $vaild->phone('852',$fields['phone']);

    if(!$vaildPhone)errHandler('fail','phone err');

    $user_obj = new User();
    $phoneResult = $user_obj->check_phone($fields['phone']);

    $countNum = 0;
    $regErr = '';

    if($phoneResult && $phoneResult['phone']){
        $countNum++;
        $regErr = 'phone1';
    }

    
    if($countNum >= 1)errHandler('fail',$regErr.' exist');

    $count_obj = new Count();
    $count_ava_result = $count_obj->check_count($data['user_group']);
    // var_dump($count_ava_result);
    $target_group_ava = intval($count_ava_result["count"]);
    if(!$target_group_ava)errHandler('fail', 'full');

    $target_group_ava--;

    $entry_obj = new Entry();
    $entry_code_result = $entry_obj->check_entry($data['user_group']);

    // 注冊
    $datetime = date('Y-m-d-H-i-s');
    $fields['create_at'] = $datetime;
    $fields['uid'] = $user_obj->gen_uid();

    $reg_result = $user_obj->group_register($fields, $entry_code_result);

    if(!$reg_result[0])errHandler('fail','register err');

    // require_once(dirname(__FILE__)."/../../../tool/Sms.php");
    // $link = 'https://seasonfinale2023.com/#/user/'.$fields['uid'];
    
    // $template = array(
    //     // 'en'=>'You’ve successfully registered for the “7.16 Season Finale Exclusive Offer”. Please click this link ('.$link.') for redemption details. T&C apply. EN/UN: 1817',
    //     'en'=>'You’ve successfully registered for the “7.16 Season Finale Exclusive Offer”. Please click this link ('.$link.') for redemption details. TC apply. EN/UN: 1817',
    //     'tc'=>'閣下已成功登記「7.16煞科日專屬禮遇」，請點擊此連結 ('.$link.') 以查閱換領詳情，受條款及細則約束。查詢/取消1817',
    // );
    // $sms_data = new stdClass();
    // $sms_data->msg  = $template[$language]; // Dynamics msg for sms, static content need to edit inside model
    // // $sms = new Sms('852',$fields['phone'],$sms_data);
    // $sms = new Sms('852','68712587',$sms_data);
    // $sms_result = $sms->sendSMS();

    

    exit(json_encode(array("status"=>"success","msg"=>"","uid"=>$fields['uid'])));
    errHandler('fail','server err');
}

function errHandler($status,$errMsg){
    exit(json_encode(array("status"=>$status,"msg"=>$errMsg)));
}




exit(http_response_code(404));

