<?php
require_once dirname(__FILE__)."/../dao/countDao.php";

class Count {
    protected $count_dao;

    public function __construct(){
        $this->count_dao = new COUNTDAO();
    }

    public function check_count($group){
        $temp_group = array("group"=>$group);
        return $this->count_dao->select_key('`group`, `count`',$temp_group);
    }

    public function update_count($fields){
        return $this->count_dao->update_record($fields);
    }
}
