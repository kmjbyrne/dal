<?php
/**
 * User: Keith Byrne
 * Date: 11/03/2017
 * Time: 15:31
 */

// dev/test
define('DBHOST','*');
define('DBUSER','*');
define('DBPASS','*');
define('DBNAME','*');
define('PORT', 3306);

// Test
class DAL {
    public function __construct(){}
    private function connect() {
        try {
            $conn = new PDO("mysql:host=".DBHOST.";port=".PORT.";dbname=".DBNAME, DBUSER, DBPASS);
            // set the PDO error mode to exception. Remember to disable in production !!!! TODO
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }
    private function query($sql, $params=array()){
        $conn = $this->connect();
        $statement = $conn->prepare($sql);

        if(!empty($params)){
            foreach($params as $key => &$value)
            $statement->bindParam(':' . $key, $value);
        }
        $statement->execute();
        if ($statement->queryString){
            if (strpos($sql,'SELECT') === false){
                return true;
            }
        }
        else{
            if (strpos($sql,'SELECT') === false){
                return false;
            }
            else{
                return null;
            }
        }
        $results = array();
        while ($row = $statement->fetchAll(PDO::FETCH_ASSOC)){
            $result = new DALQueryResult();
            foreach ($row as $k=>$v){
                $result->$k = $v;
            }
            $results[] = $result;
        }
        return $results;
    }
}

class DALQueryResult {
    private $_results = array();
    public function __construct(){}
    public function __set($var,$val){
        $this->_results[$var] = $val;
    }
    public function __get($var){
        if (isset($this->_results[$var])){
            return $this->_results[$var];
        }
        else{
            return null;
        }
    }
}
