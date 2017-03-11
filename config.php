<?php
/**
 * Created by PhpStorm.
 * User: Keith Byrne
 * Date: 11/03/2017
 * Time: 17:30
 */

namespace DAL\Config;

class DALAccessConfig{
    private $host;
    private $dbName;
    private $dbPassword;
    private $dbUsername;
    private $port;

    public function __construct($host, $port, $dbName, $dbUser, $dbPass){
        $this->host = $host;
        $this->dbName = $dbName;
        $this->dbUsername = $dbUser;
        $this->dbPassword = $dbPass;
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getDbPassword()
    {
        return $this->dbPassword;
    }

    /**
     * @param mixed $dbPassword
     */
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;
    }

    /**
     * @return mixed
     */
    public function getDbUsername()
    {
        return $this->dbUsername;
    }

    /**
     * @param mixed $dbUsername
     */
    public function setDbUsername($dbUsername)
    {
        $this->dbUsername = $dbUsername;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * @param mixed $dbName
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
    public function generateConnectionString(){
        return "mysql:host=".$this->getHost().";port=".$this->getPort().";dbname=".$this->getdbName(), $this->getDbUsername(),$this->getDbPassword();
    }
}