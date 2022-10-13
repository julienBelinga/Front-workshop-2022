<?php



function connect(){
    $servername   = "localhost";
    $database = "workshop2022";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function begin(){
    $conn = connect();

    #save current timestamp
    $start_time = time();
    $start_time = date("Y-m-d H:i:s");

    #insert start_time
    $sql = "INSERT INTO worktime (start_time) VALUES ('".$start_time."')";

    if($conn->query($sql)){
        $last_id = $conn->insert_id;
    }
    if($conn->errno){
        echo $conn->errno;
    }
    $conn->close();

    return $last_id;
}

function endTime($last_id){
    $conn = connect();

    #save current timestamp
    $timestamp = time();
    $timestamp = date("Y-m-d H:i:s");

    #get start_time
    $sql = "SELECT start_time FROM `worktime` WHERE id_worktime = ".$last_id."";
    if($conn->query($sql)){
        echo 'hello </br>';
        $start_time = $conn->query($sql);
    }
    if($conn->errno){
        echo $conn->errno;
    }

    #calculate $time
    // $time = strtotime($timestamp) - strtotime($start_time);
    // $time = date("Y-m-d H:i:s");


    // var_dump($timestamp);

    #insert end_time and time
    $sql = "UPDATE worktime SET (end_time) VALUES ('".$timestamp."') WHERE id_worktime = ".$last_id."";
    if($conn->query($sql)){
        echo '  end time done.';
    }
    if($conn->errno){
        echo $conn->errno;
    }
}
  
$last_id = begin();
endTime($last_id);
?>