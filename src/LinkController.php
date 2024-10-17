<?php

require_once "DataBaseController.php";

class LinkController {

    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    public function getLinks() {
        $sql = "SELECT * FROM links";
        
        try  {
            $result = $this->executeQuery($sql);
            
            return $result;

          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
    }

    public function exist(String $token) {
        $exist = false;
        $sql = "SELECT * FROM links WHERE Token = '$token'";
        
        try  {
            $result = $this->executeQuery($sql);
            
            foreach($result as $obj) {
                $tr = $obj->Token;
                if($tr == $token) {
                    $exist = true;
                    break;}
                
                }

                if($exist == true) return true;
                else return false;
                
          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
    }

    public function getLink(String $token) {
        $existToken = $this->exist($token);
        if($existToken == true) return $token;
        else return null;
    }

    public function addUsage(String $token){
        $sql = "UPDATE links SET Usages = Usages +1 WHERE Token = '$token'";
        
        try  {
            $result = $this->executeQuery($sql);
            
            return true;

          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
              return false;
          }
    }

    public function numberOfUsages(String $token){
        $sql = "SELECT Usages FROM links WHERE Token = '$token'";
        
        try  {
            $result = $this->executeQuery($sql);
            
            foreach($result as $obj) $result = $obj->Usages;
            
            return $result;
            
          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
              return null;
          }
    }

    public function executeQuery(String $sql){
        $statement = $this->connection->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $statement->execute();
  
        $result = $statement->fetchAll();
        return $result;
    }

    public function generateHash(int $size){
        $alphabet = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4","5", "6", "7", "8", "8", "9");
	    $max = sizeof($alphabet) - 1;
	    $size = "";
	    $letter = "";
	    for ($i = 0; $i < $size; $i++) {
		    $letter = $alphabet[rand(0, $max)];
		    $word .= $letter;
	    }

	    return $hash;
    }

    public function createLink(){
        $existToken = false;
        while($existToken == true){
            try{
                $link = $this->generateHash(32);
                $existToken = $this->exist($link);
                if($existToken) {
                    $sql = "INSERT INTO tu_tabla (Token, Usages) VALUES ('$link', 0)";
                    $this->executeQuery($sql);
                }
            }catch(PDOException $error) {
                return null;
            }
        } return $link;
    }
    }
