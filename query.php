<?php

    function connect(){
        $dsn = 'mysql:dbname=workshop2022;host=127.0.0.1';
        $user = 'root';
        $password = '';

        $dbh = new PDO($dsn, $user, $password);

        return $dbh;
    }

    function debut(){
        $dbh = connect();
        
        // prepare and bind
        $sql = "INSERT INTO worktime (`start_time`) VALUES (`".time()."`)";
        $result = $dbh->prepare($sql);
		$result->execute();

        $_SESSION['begin'] = false;
    }

    function fin(){
        $dbh = connect();

        //SELECT query to get start_time
        $sql = "SELECT worktime `start_time` WHERE fk_user = 1";
        $result = $dbh->prepare($sql);
		$start_time = $result->execute();

        $end_time = time();
        $time = $end_time - $start_time;
        
        // set parameters
        $sql = "UPDATE INTO worktime `end_time`,`time` VALUES `".$end_time."`, `".$time."` WHERE fk_user = 1";
        $result = $dbh->prepare($sql);
		$result->execute();

        $_SESSION['begin'] = true;
    }

    function clickbtn(){
        $_SESSION['begin'] = $_SESSION['begin'];
        if($_SESSION['begin']){
            debut();
        }else{
            fin();
        }
    }
?>