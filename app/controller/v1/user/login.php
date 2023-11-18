<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = json_decode(file_get_contents('php://input'),true);
    
    $login_type = '';
    if(array_key_exists('phone',$fields)){
        $login_type = 'phone';
    }elseif(array_key_exists('uid',$fields)){
        $login_type = 'uid';
    }else{
        exit(http_response_code(404));
    }


    require_once(dirname(__FILE__)."/../../autoload.php");

    $user_obj = new User();
    $entry_obj = new Entry();


    if($login_type == 'phone'){
        $type = array('phone'=>$fields['phone']);
    }elseif($login_type == 'uid'){
        $type = array('uid'=>$fields['uid']);
    }

    $select_column = '`uid`,`user_group`,`prize1`,`prize2`,`prizeg`,`game`';
    $result = $user_obj->login($select_column,$type);
    
    if($result && $result['uid']){

        if($result['user_group'] != 0){
            $entry_code_result = $entry_obj->get_code($fields['uid']);
            if(!$entry_code_result){
                if(substr($result['uid'],0,10) == 'hkjctestac'){
                    $entry_code_result = array(
                        "display"=>"",
                        "qrcode"=>""
                    );
                }else{
                    errHandler('fail', 'no entry');
                }
            }
        }else{
            $entry_code_result = array(
                "display"=>"",
                "qrcode"=>""
            );
        }

        $result['game'] = getGameStatus(json_decode($result['game'],true));
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

function getGameStatus($game){
  $temp_arr = array();
  $total = 0;
  for($i = 1; $i <= 9; $i++){
    $temp_arr[$i] = $game[$i]['status'];
    if($game[$i]['status']){
      $total++;
    }
  }
  $temp_arr['unlock'] = $game['unlock'];
  $temp_arr['total'] = $total;
  return $temp_arr;
}