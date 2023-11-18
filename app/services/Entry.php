<?php
require_once dirname(__FILE__)."/../dao/entryDao.php";

class Entry {
    protected $entry_dao;

    public function __construct(){
        $this->entry_dao = new ENTRYDAO();
    }

    

    public function check_entry($group){
        $temp_group = array("group"=>$group);
        return $this->entry_dao->select_ava_code('`qrcode`, `display`',$temp_group);
    }

    public function get_code($uid){
        $temp_group = array("uid"=>$uid);
        return $this->entry_dao->select_key('`qrcode`, `display`',$temp_group);
    }

    public function update_count($fields){
        return $this->entry_dao->update_record($fields);
    }
}
