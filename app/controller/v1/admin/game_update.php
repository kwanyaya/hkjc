<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once(dirname(__FILE__)."/../../../middleware/auth.php");
    jwt_auth(); //level

    require_once(dirname(__FILE__)."/../../autoload.php");

    $data = json_decode(file_get_contents("php://input"),true);



    if(!array_key_exists('uid',$data) || !array_key_exists('game',$data)|| !array_key_exists('p',$data)){
        http_response_code(404);
        exit();
    }

    $json = false;

    $c_datetime = date('Y-m-d-H-i-s');

    if($data['game'] == 'game1'){

        $json = true;

        $fields = array(
            "uid"=>$data['uid'],
            $data['game']=>"JSON_REPLACE(`".$data['game']."`, '$.".$data['p'].".status', 1, '$.unlock',1, '$.".$data['p'].".update_at','$c_datetime')",
        );
    }

    if($data['game'] == 'game2'){
        $json = true;

        $fields = array(
            "uid"=>$data['uid'],
            $data['game']=>"JSON_REPLACE(`".$data['game']."`, '$.".$data['p'].".status', 1, '$.unlock',1, '$.".$data['p'].".update_at','$c_datetime')",
        );
    }

    if($data['game'] == 'prizeg'){

        $fields = array(
            "uid"=>$data['uid'],
            $data['game']=>1,
            $data['game'].'_redeem_at'=>$c_datetime
        );
    }

    if($data['game'] == 'coin'){
        $fields = array(
            "uid"=>$data['uid'],
            $data['p']=>1,
            $data['p'].'_redeem_at'=>$c_datetime
        );
    }

    if(!isset($fields)){
        errHandler('fail','update err');
    }

    $user_obj = new User();

    if($json){
        $result = $user_obj->update_status_byjson($fields);
    }else{
        $result = $user_obj->update_status($fields);
    }



    if(!$result)errHandler('fail','update err');
    exit(json_encode(array("status"=>"success","msg"=>"")));

    errHandler('fail','server err');
}

function errHandler($status,$errMsg){
    exit(json_encode(array("status"=>$status,"msg"=>$errMsg)));
}

exit(http_response_code(404));

