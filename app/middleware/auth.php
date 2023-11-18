<?php
if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    http_response_code(404);
    exit();
}
function jwt_auth(){
    require_once(dirname(__FILE__)."/../tool/JWT.php");

    $jwt_obj = new JWT();

    $headerStringValue = array_change_key_case(getallheaders(), CASE_LOWER);

    $token = null;
    @$tokens = $headerStringValue['authorization'];

    if (strpos(strtolower($tokens), 'bearer') === 0 ||$tokens != null) {
        $Authorization = explode(' ', $tokens);
        if(@$Authorization[1]){
            
            $jwt = $Authorization[1];
            $getPayload=Jwt::verifyToken($jwt);

            if($getPayload){
                return $getPayload;
            }
        }
        logoutHandler('logout','token err');
    }
    logoutHandler('logout','token err');
    // exit(http_response_code(404));
}

function logoutHandler($status,$errMsg){
    exit(json_encode(array("status"=>$status,"msg"=>$errMsg)));
}
