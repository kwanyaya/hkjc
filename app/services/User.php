<?php
require_once dirname(__FILE__)."/../dao/userDao.php";

interface UID{
    public function gen_uid();
}

class User implements UID{
    protected $user_dao;

    public $field_one = 
    '{            
        "unlock":0,
        "1":{
            "status":0,
            "update_at":""
        },
        "2":{
            "status":0,
            "update_at":""
        },
        "3":{
            "status":0,
            "update_at":""
        },
        "4":{
            "status":0,
            "update_at":""
        },
        "5":{
            "status":0,
            "update_at":""
        },
        "6":{
            "status":0,
            "update_at":""
        },
        "7":{
            "status":0,
            "update_at":""
        },
        "8":{
            "status":0,
            "update_at":""
        },
        "9":{
            "status":0,
            "update_at":""
        }
    }';

    public function __construct(){
        $this->user_dao = new USERDAO();
    }
    public function register($fields){

        $fields['game'] = $this->field_one;

        return $this->user_dao->insert_record($fields);
    }
    public function group_register($fields, $entry_code_result){

        $fields['game2'] = $this->field_one;

        return $this->user_dao->insert_group_record($fields, $entry_code_result);
    }
    public function check_phone($phone){
        $fields = array(
            "phone"=>$phone
        );
        return $this->user_dao->selectC_by_obj($fields);
    }
    public function check_uid($uid){
        $fields = array(
            "uid"=>$uid
        );
        return $this->user_dao->selectC_by_obj($fields);
    }
    
    public function login($select_column,$key){
        return $this->user_dao->select_key($select_column,$key);
    }

    public function update_status($fields){
        return $this->user_dao->update_record($fields);
    }

    public function update_status_byjson($fields){
        return $this->user_dao->update_json_user($fields);
    }

    public function return_id(){
        return $this->user_dao->return_id();
    }

    
    public function gen_uid(){
        $str = md5(uniqid('',true));
        $uid = substr($str,-13);
        return $uid;
    }

}

