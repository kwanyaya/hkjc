<?php


    date_default_timezone_set('Asia/Hong_Kong');
   
    // require_once(dirname(__FILE__)."/../../../services/User.php");
    // require_once(dirname(__FILE__)."/../../../services/Count.php");
    // require_once(dirname(__FILE__)."/../../../services/Entry.php");


    //exit(json_encode(array("status"=>"success","msg"=>"","uid"=>$fields['uid'])));
    //errHandler('fail','server err');

    $i=1;
    while($i <= (3000-1896)){
        // reg();
    }

function reg(){

   

    $fields['user_group'] = 4;
    $fields['phone'] = null;

    require_once(dirname(__FILE__)."/../../../tool/Validation.php");


    $user_obj = new User();
  
    $count_obj = new Count();
    $count_ava_result = $count_obj->check_count(4);
    // var_dump($count_ava_result);
    $target_group_ava = intval($count_ava_result["count"]);
    if(!$target_group_ava)errHandler('fail', 'full');

    $target_group_ava--;

    $entry_obj = new Entry();
    $entry_code_result = $entry_obj->check_entry(4);

    // 注冊
    $datetime = date('Y-m-d-H-i-s');
    $fields['create_at'] = $datetime;
    $fields['uid'] = "kl".$user_obj->gen_uid();

    $reg_result = $user_obj->group_register($fields, $entry_code_result);

    if(!$reg_result[0])errHandler('fail','register err');

}

function errHandler($status,$errMsg){
    exit(json_encode(array("status"=>$status,"msg"=>$errMsg)));
}




exit(http_response_code(404));

