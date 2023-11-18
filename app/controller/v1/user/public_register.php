<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Asia/Hong_Kong');
    require_once(dirname(__FILE__)."/../../../services/User.php");

    $data = json_decode(file_get_contents("php://input"),true);

    $fields['user_group'] = '0';
    $fields['phone'] = $data['phone'];

    require_once(dirname(__FILE__)."/../../../tool/Validation.php");

    $vaild = new Validation();
    $vaildPhone = $vaild->phone('852',$fields['phone']);

    if(!$vaildPhone)errHandler('fail','phone err');

    $user_obj = new User();
    $phoneResult = $user_obj->check_phone($fields['phone']);

    if($phoneResult && $phoneResult['phone']){
        // login
        // $select_column = '`uid`,`user_group`';
        // $result = $user_obj->login($select_column,array('phone'=>$phoneResult['phone']));
        // $return_obj = $result;
        // exit(json_encode(array("status"=>"success","user_info"=>$return_obj)));
        
        // TODO:對應返回/問下 public 注冊如果已經有呢個record點做，印象中有err msg
        $regErr = 'phone1';
        errHandler('fail',$regErr.' exist');
    }else{

        // 注冊
        $datetime = date('Y-m-d-H-i-s');
        $fields['create_at'] = $datetime;
        $fields['uid'] = $user_obj->gen_uid();

        $reg_result = $user_obj->register($fields);

        if(!$reg_result[0])errHandler('fail','register err');

        $return_obj = array(
            "uid"=>$fields['uid'],
            "user_group"=>"0"
        );
        exit(json_encode(array("status"=>"success","user_info"=>$return_obj)));
    }

    errHandler('fail','server err');
}

function errHandler($status,$errMsg){
    exit(json_encode(array("status"=>$status,"msg"=>$errMsg)));
}




exit(http_response_code(404));

