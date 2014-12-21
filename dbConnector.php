<?php

class DbConnector {

var $theQuery;
var $link;

function DbConnector(){

        
        $host = 'localhost';
        $db = 'pharmge_diary';
        $user = 'pharmge_root';
        $pass = 'Kb0NRrtp2rVU';

        $this->link = mysql_connect($host, $user, $pass);
        mysql_select_db($db);
        register_shutdown_function(array(&$this, 'close'));

    }
	
 
    function query($query) {

        $this->theQuery = $query;
        return mysql_query($query, $this->link);

    }

    
    function fetchArray($result) {

        return mysql_fetch_array($result);

    }

    
    function close() {

        mysql_close($this->link);

    }
	
}

?>