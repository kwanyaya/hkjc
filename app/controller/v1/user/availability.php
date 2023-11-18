<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Asia/Hong_Kong');
    require_once(dirname(__FILE__)."/../../../services/Count.php");

    $data = json_decode(file_get_contents("php://input"),true);

    if(!isset($data['user_group']) || ($data['user_group'] == '' && $data['user_group'] != 0)){
        errHandler('fail','user_group not found');
    }
    $fields['user_group'] = $data['user_group'];


    $count_obj = new Count();
    $count_ava_result = $count_obj->check_count($data['user_group']);
    // var_dump($count_ava_result);
    $target_group_ava = intval($count_ava_result["count"]);
    if(!$target_group_ava)errHandler('fail', 'full');

    exit(json_encode(array("status"=>"success","msg"=>"success")));
    errHandler('fail','server err');
}

function errHandler($status,$errMsg){
    exit(json_encode(array("status"=>$status,"msg"=>$errMsg)));
}




exit(http_response_code(404));

