<?php
require(dirname(__FILE__)."/../config/Database.php");
class Video extends Database{
    private $userTable = 'hkjc_eventist_video';

    
    public function selectVideoAc($uid,$date_type){
        $column = '*';
        $sql = "SELECT $column FROM $this->userTable WHERE uid = :uid and type = :type limit 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(":uid",$uid);
        $stmt->bindValue(":type",$date_type);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function bindAc($uid,$vuid){
        $sql ="UPDATE $this->userTable SET uid = :uid ";
        $sql.="WHERE vuid = :vuid ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(':vuid', $vuid);
        $stmt->bindValue(':uid', $uid);
        try{
            $result =  $stmt->execute();
        }catch(PDOException $e){
            // print_r( $e);
            return false;
        }

        return $result;
    }
    public function availablevuid($type){
        $column = '*';
        $sql = "SELECT $column FROM $this->userTable WHERE uid = '' and type = :type limit 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(":type",$type);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

