<?php
class DB 
{
    var $host       = "";
    var $port       = "";
    var $dbname     = "";
    var $user       = "";
    var $password   = "";
    var $dbconnect  = "";
    
    function __construct($host,$dbname,$user,$password)
    {
        $this->host     = $host;
        $this->dbname   = $dbname;
        $this->user     = $user;
        $this->password = $password;
        
    }
    function connect()
    {
        $this->dbconnect =  mysql_connect('localhost', 'id1753604_user', '123123');
        if (!$this->dbconnect ) {
            die('Ошибка соединения: ' . mysql_error());
        }
        if (!mysql_select_db($this->dbname))
            die("Can't select database");
    }

    function executeQuery($query)
    {
	    $result = mysql_query($query);
        return $result;
    }

    function close()
    {   
        mysql_close($this->dbconnect);
    }
}