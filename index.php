<?php

if(isset($_POST['uid'])){
	require 'connection.php';

	// prepare and bind
    $coordinate = isset($_POST['coordinate'])?json_encode($_POST['coordinate']):"";
    $last = json_encode($_POST['last']);
	$stmt = $conn->prepare("update `activity_log` set  description = ? ,log_name = ? where id = ?");
    $stmt->execute([$coordinate, $last, 1]);
	$conn = null;
}
else if(isset($_GET['puid'])){
	require 'connection.php';
    $stmt = $conn->query("SELECT id, description, log_name FROM activity_log where id = 1");
    foreach ($stmt as $row){
        if($row['description']){
            $result =  $row['description'];
        }else{
            $result =  $row['log_name'];
        }
//        $result =  $result;
        break;
    }
    header('Content-type: application/json');
    echo $result;
    $conn = null;

//    var_dump($stmt);
//    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
//        echo $v;
//    }
//    while ($row = $stmt->fetch()) {
//        if($row['description']){
//            echo $row['description'];
//        }else{
//            echo $row['log_name'];
//        }
//    }
}
