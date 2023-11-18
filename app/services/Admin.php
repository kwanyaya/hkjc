<?php
require_once dirname(__FILE__)."/../dao/userDao.php";

class Admin{
    protected $user_dao;

    public function __construct($type){
        $this->user_dao = new USERDAO($type);
    }
    
    public function select_invitation($column,$whereCase){
        return $this->user_dao->select_alls($column,$whereCase);
    }
    
    public function unlock($value){
        return $this->user_dao->update_alls($value);
    }

}
