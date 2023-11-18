<?php
require_once dirname(__FILE__)."/../config/Database.php";

abstract class DB{
    protected $db;
    public function __construct() {
        $this->db = new Database();
    }
}

class USERDAO extends DB{
    private $table = "hkjc_game";

    public function selectC_by_obj($fields){

        $column = array_keys($fields)[0];
        $value = array_values($fields)[0];

        try{
            $sql = "select $column FROM $this->table";
            $sql.=" WHERE $column = :value";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(":value", $value);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            err($e);
        }
        return $row;
    }

    public function selectAll_by_obj($fields){
        // 暫時未用
        $column = array_keys($fields)[0];
        $value = array_values($fields)[0];

        try{
            $sql = "select * FROM $this->table";
            $sql.=" WHERE $column = :value";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(":value", $value);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            err($e);
        }
        return $row;
    }
    
    public function select_key($column,$whereCase){
        $where_column = array_keys($whereCase)[0];
        $value = array_values($whereCase)[0];

        try{
            $sql = "select $column FROM $this->table";
            $sql.=" WHERE $where_column = :value";

            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(":value", $value);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            err($e);
        }
        return $row;
    }

    public function insert_record($fields){
        $implodeColums = implode(',',array_keys($fields));
        $implodePlaceholder = implode(", :",array_keys($fields));
        $sql = "INSERT INTO $this->table ($implodeColums) VALUES (:". $implodePlaceholder.")";
        
        try{
            $conn = $this->db->connect();
            $stmt = $conn->prepare($sql);
            foreach ($fields as $key => $value){
                $stmt->bindValue(':'.$key,$value);
                // print_r($value);
            };

            $stmtExec = $stmt->execute();
            $lastId = $conn->lastInsertId();
        }catch(PDOException $e){
            err($e);
        }

        // return $row;

        return [$stmtExec,$lastId];
    }

    public function insert_group_record($fields, $entry_code_result){
        $conn = $this->db->connect();
        $conn->beginTransaction();


        $count_sql = "UPDATE `hkjc_game_count` SET `count` = `count` - 1 WHERE `group` = :group AND `count` > 0";

        try{
            $stmt = $conn->prepare($count_sql);
            $stmt->bindValue(':group', $fields["user_group"]);
            $stmtExec = $stmt->execute();
        } catch(PDOException $e){
            err($e);
        }
        if(!$stmt->rowCount()){
            $conn->rollBack();
            return false;
        }

        $entry_sql = "UPDATE `hkjc_game_entry` SET `uid` = :uid WHERE `qrcode` = :qrcode AND `uid` IS NULL";

        try{
            $stmt = $conn->prepare($entry_sql);
            $stmt->bindValue(':uid', $fields["uid"]);
            $stmt->bindValue(':qrcode', $entry_code_result["qrcode"]);
            $stmtExec = $stmt->execute();
        } catch(PDOException $e){
            err($e);
        }
        if(!$stmt->rowCount()){
            $conn->rollBack();
            return false;
        }

        $implodeColums = implode(',',array_keys($fields));
        $implodePlaceholder = implode(", :",array_keys($fields));
        $sql = "INSERT INTO $this->table ($implodeColums) VALUES (:". $implodePlaceholder.")";
        
        try{
            $stmt = $conn->prepare($sql);
            foreach ($fields as $key => $value){
                $stmt->bindValue(':'.$key,$value);
                // print_r($value);
            };

            $stmtExec = $stmt->execute();
            $lastId = $conn->lastInsertId();
        }catch(PDOException $e){
            $conn->rollBack();
            err($e);
            return false;
        }

        $conn->commit();

        // return $row;

        return [$stmtExec,$lastId];
    }
    
    public function return_id(){
        $sql = "SELECT LAST_INSERT_ID()";
        try{
            $stmt = $this->db->connect()->prepare($sql);
            $stmtExec = $stmt->execute();
        }catch(PDOException $e){
            err($e);
        }
        return $stmtExec;
    }

    public function update_record($fields){
        $st = "";
        $counter = 2;
        $total_fields = count($fields);

        $uid = $fields['uid'];
        unset($fields['uid']);

        foreach ($fields as $key => $value){
            if($counter === $total_fields){
                $set = "`$key` = :".$key;
                $st = $st.$set;
            }else{
                $set = "`$key` = :".$key.", ";
                $st = $st.$set;
                $counter++;
            }
        }
        $sql = "";
        $sql.="UPDATE $this->table SET ".$st;
        $sql.=" WHERE uid = :uid ";

        try{
            $stmt = $this->db->connect()->prepare($sql);
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            };
            $stmt->bindValue(':uid', $uid);
            $stmtExec = $stmt->execute();
        }catch(PDOException $e){
            err($e);
        }
        if(!$stmt->rowCount()){
            return false;
        }
        return $stmtExec;
    }


    public function update_json_user($fields){
        $st = "";
        $counter = 2;
        $total_fields = count($fields);

        $uid = $fields['uid'];
        unset($fields['uid']);


        foreach ($fields as $key => $value){
            if($counter === $total_fields){
                $set = "`$key` = ".$value;
                $st = $st.$set;
            }else{
                $set = "`$key` = ".$value.", ";
                $st = $st.$set;
                $counter++;
            }
        }



        $sql = "";
        $sql.="UPDATE $this->table SET ".$st;
        $sql.=" WHERE uid = :uid ";

        // echo "<br>";

        try{
            $stmt = $this->db->connect()->prepare($sql);

            // foreach ($fields as $key => $value) {
            //     $stmt->bindValue(':' . $key, $value);
            // };

            $stmt->bindValue(':uid', $uid);
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

function err($e){
    print_r($e);
    return false;
}