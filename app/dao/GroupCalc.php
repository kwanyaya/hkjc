<?php
require_once dirname(__FILE__)."/../config/Database.php";

abstract class DB{
    protected $db;
    public function __construct() {
        $this->db = new Database();
    }
}

class GroupCalc extends DB{
    private $table = "hkjc_game";

}

function err($e){
    print_r($e);
    return false;
}