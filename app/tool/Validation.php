<?php

class Validation{
    public function email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public function phone($cc,$phone){
        switch($cc){
            case 62:
                if(strlen($phone) >= 8 && strlen($phone) <=12){
                    return false;
                }
                break;
            case 852:
                if(!is_numeric($phone)){
                    return false;
                }
                if(strlen($phone) != 8){
                    return false;
                }
                $vali = ['0','1','2','3'];
                $si = substr($phone,'0','1');
                foreach($vali as $value ){
                    if($si == $value){
                        return false;
                    }
                }
                break;
            case 853:
                if(strlen($phone) != 8){
                    return false;
                }
                $vali = ['1','2','3'];
                $si = substr($phone,'0','1');
                foreach($vali as $value ){
                    if($si == $value){
                        return false;
                    }
                }
                break;
            default:
                return false;
                break;
        }
        return true;
    }
}