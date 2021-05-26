<?php

// SQL만 인자로 넣어서 CRUD를 할 수 있는 함수들.

function DB__getRow($sql){

    global $dbConn;
    $rs = mysqli_query($dbConn, $sql);
    $row = mysqli_fetch_assoc($rs);

    return $row;
}

function DB__getRows($sql){
    
    global $dbConn;
    $rs = mysqli_query($dbConn, $sql);
    $rows = [];

    while($row = mysqli_fetch_assoc($rs)){
        $rows[] = $row;
    }
    return $rows;
}

function DB__insert($sql){
    global $dbConn;
    mysqli_query($dbConn, $sql);

    return mysqli_insert_id($dbConn);
}

function DB__update($sql){
    global $dbConn;
    mysqli_query($dbConn, $sql);
}

function DB__delete($sql){
    global $dbConn;
    mysqli_query($dbConn, $sql);
}


?>