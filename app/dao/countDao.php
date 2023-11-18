<?php
require_once dirname(__FILE__)."/../config/Database.php";

abstract class DBase{
    protected $db;
    public function __construct() {
        $this->db = new Database();
    }
}

class COUNTDAO extends DBase{
    private $table = "hkjc_game_count";

    public function select_key($column,$whereCase){

        $where_column = array_keys($whereCase)[0];
        $value = array_values($whereCase)[0];

        $value = intval($value);

        try{
            $sql = "SELECT $column FROM $this->table";
            $sql.=" WHERE `$where_column`= :value";

            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(":value", $value);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            err($e);
        }
        return $row;
    }

    public function update_record($fields){
        $sql = "UPDATE $this->table SET `count` = :count_test WHERE `group` = :group AND `count` > 0";
        try{
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(':count_test', $fields["count"]);
            $stmt->bindValue(':group', $fields["user_group"]);
            $stmtExec = $stmt->execute();
        }catch(PDOException $e){
            err($e);
        }
        if(!$stmt->rowCount()){
            return false;
        }
        return $stmtExec;
    }
}