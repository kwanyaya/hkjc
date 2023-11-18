<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Asia/Hong_Kong');
    $data = json_decode(file_get_contents("php://input"),true);

    require_once(dirname(__FILE__)."/../../../tool/JWT.php");

    if(!array_key_exists('password',$data)){
        http_response_code(404);
        exit();
    }
    
    if(isset($data['username']) || isset($data['password'])){
        $username = $data['username'];
        $password = $data['password']; 

        if($password !== ''){
            switch($username){
                case 'hkjc2023coffee':
                    $ac_login = "hkjc2023coffee";
                    $ac_password = "hkjc2023coffee";
                    $level = '3';
                    break;
                case 'hkjc2023beer':
                    $ac_login = "hkjc2023beer";
                    $ac_password = "hkjc2023beer";
                    $level = '3';
                    break;
                case 'hkjc2023mo':
                    $ac_login = "hkjc2023mo";
                    $ac_password = "hkjc2023mo";
                    $level = '1';
                    break;
                case 'hkjc2023Backstage':
                    $ac_login = "hkjc2023Backstage";
                    $ac_password = "hkjc2023Backstage";
                    $level = '2';
                    break;
                default:
                    errHandler("fail","賬號或密碼錯誤");
                    break;
            }
            $salt = "asdsadq2133cc";

            if($username === $ac_login && $password === $ac_password){
                // echo json_encode(array("status"=>"fail","msg"=>"login"));
                $jwt = new JWT();
                // //自己使用测试begin
                $payload_test=array(
                    'iss'=>'admin',
                    'iat'=>time(),
                    'exp'=>time()+7200,
                    'nbf'=>time(),
                    'sub'=>'toryburch',
                    'jti'=>md5(uniqid($salt).time()),
                    'level'=>$level
                );;

                $token=Jwt::getToken($payload_test);
                exit(json_encode(array("status"=>"success","jwt"=>$token,"role"=>$level)));
            }else{
                errHandler("fail","賬號或密碼錯誤");
            }
        }
    }

}else{
    http_response_code(404);
    exit();
}

function errHandler($status,$errMsg){
    exit(json_encode(array("status"=>$status,"msg"=>$errMsg)));
}

exit(http_response_code(404));

