<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require_once(dirname(__FILE__)."/../../../middleware/auth.php");
    jwt_auth(); //level
    
    $fields = json_decode(file_get_contents('php://input'),true);
    require_once(dirname(__FILE__)."/../../autoload.php");
    $login_type = '';
    if(array_key_exists('uid',$fields)){
        $login_type = 'uid';
    }else{
        exit(http_response_code(404));
    }



    $user_obj = new User();
    $entry_obj = new Entry();


    if($login_type == 'uid'){
        $type = array('uid'=>$fields['uid']);
    }

    $select_column = '`uid`,`phone`,`user_group`,`prize1`,`prize2`,`prizeg`,`game1`,`game2`,`create_at`';
    $result = $user_obj->login($select_column,$type);
    
    if($result && $result['uid']){
        $entry_code_result = $entry_obj->get_code($fields['uid']);

        // print_r($entry_code_result);

        if(!$entry_code_result){
            $entry_code_result = array(
                "display"=>""
            );
        }

        $result['game1']= json_decode($result['game1']); 
        $result['game2']= json_decode($result['game2']); 

        $return_obj = array_merge($result, $entry_code_result);

        exit(json_encode(array("status"=>"success","user_info"=>$return_obj)));

    }else{
        errHandler('fail','no user');
    }
    errHandler('fail','server err');
}else{
    http_response_code(404);
    exit();
}


function errHandler($status,$errMsg){
    exit(json_encode(array("status"=>$status,"msg"=>$errMsg)));
}

