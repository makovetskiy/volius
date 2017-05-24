<?php
class DB 
{
    var $host       = "";
    var $port       = "";
    var $dbname     = "";
    var $user       = "";
    var $password   = "";
    var $dbconnect  = "";
    
    function __construct($host,$port,$dbname,$user,$password)
    {
        $this->host     = $host;
        $this->port     = $port;
        $this->dbname   = $dbname;
        $this->user     = $user;
        $this->password = $password;
        
    }
    function connect()
    {
        $connect_string = "host=".$this->host.
                          " port=".$this->port. 
                          " dbname=".$this->dbname.
                          " user=".$this->user. 
                          " password=".$this->password;
        $this->dbconnect = pg_connect($connect_string) or die('connection failed');
    }

    function executeQuery($query)
    {
	    $result = pg_query($this->dbconnect, $query);
        return $result;
    }

    function close()
    {   
        pg_close($this->dbconnect);
    }
}