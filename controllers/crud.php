<?php
    $con = mysqli_connect('localhost', 'root', '', 'winzelle');

    function create($query){
        global $con;
        mysqli_query($con, $query);
        return mysqli_affected_rows($con);
    }

    function read($query){
        global $con;
        $query = mysqli_query($con, $query);
        $datas = [];
        while($data = mysqli_fetch_assoc($query)){
            $datas[] = $data;
        }
        return $datas;
    }

    function update($query){
        global $con;
        mysqli_query($con, $query);
    }

    function delete($query){
        global $con;
        mysqli_query($con, $query);
    }

?>