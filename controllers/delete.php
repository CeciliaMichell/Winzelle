<?php 
    include_once 'crud.php';

    function deleteCRUD($from, $condition){
        return delete("DELETE FROM $from WHERE $condition");
    }
?>
