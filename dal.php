<?php
/**
 * User: Keith Byrne
 * Date: 11/03/2017
 * Time: 15:31
 */

namespace DAL;
use DAL\Config as Config;

class DAL {
    private $config;
    public function __construct($DBHOST, $DBUSER, $DBPASS, $DBNAME, $PORT){
        // Config is expected to be 5 key value array
        $config = new Config\Config($DBHOST, $DBUSER, $DBPASS, $DBNAME, $PORT);
        $this->config = $config;
    }
    private function connect() {
        try {
            $conn = new PDO("mysql:host=".$this->config->getHost().";port=".PORT.";dbname=".DBNAME, DBUSER, DBPASS);
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
