<?php 

include_once 'display.php';
$error = [];

function validateEmail($email){
    if(empty($email)){
       return $error['err_email'] = 'email required!';
    }
    $result = getData("*", "user", "userEmail LIKE '$email'");
    if(count($result) != 0){
        $result = $result[0];
        if($result['userEmail'] == $email){
            return $error['err_email'] = 'email already taken!';
        }
    }
    else{
        $cnt = 0; $format = true;
        $len = strlen($email);
        if($len-5 > 0 && $email[$len-1] != 'm' && $email[$len-2] != 'o' && $email[$len-3] != 'c' && $email[$len-4] != '.'){
            $format = false;
        }
        for($i = 0; $i < $len; $i++){
            if($email[$i] == '@') $cnt++;
        }
        if(!$format || $cnt != 1){
            return $error['err_email'] = 'invalid e-mail format!';
        }
    }
}

function validateName($name){
    $len = strlen($name); 
    if(empty($name)){
        return $error['err_uname'] = 'username required!';
    }
    if($len < 6 || $len > 20){
        return $error['err_uname'] = 'username must be between 6-20 chars!';
    }
    if(isset($error['err_uname'])) return $error['err_uname'];
}

function validatePassword($password){
    $len = strlen($password);
    if($len == 0){
        return $error['err_pass'] = 'password required!';
    }
    if($len < 8){
        return $error['err_pass'] = 'password at least 8 chars long!';
    }
}

function validateConfirm($password, $confirm){
    $len = strlen($confirm);
    if($len == 0){
        return $error['err_cpass'] = 'password required!';
    }
    if($password != $confirm){
        return $error['$err_cpass'] = 'please correctly confirm the password!';
    }
}

function emailExists($email){
    if(empty($email)){
       return $error['err_email'] = 'email required!';
    }
    $result = getData("*", "user", "userEmail LIKE '$email'");
    if(count($result) == 0){
        return $error['err_email'] = 'email is not registered!';
    }
}

function changeProfile($ctg){
    global $conn;
    
    $error = [];
    if(isset($_FILES['photo'])){
        if(strlen($_FILES['photo']['name']) == 0) $error['err_data'] = 'images required!';;
        $extension = array('png', 'jpg', 'jpeg');
        $profileExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

        if(!in_array($profileExtension, $extension)){
            $error['err_data'] = 'images invalid format!';
        }
        else if($_FILES['photo']['size'] > 200000){
            $error['err_data'] = 'images must be under 200KB!';
        }
        else{
            $img = '../img/'.$ctg.'/'.accDate().'.'.$profileExtension;
            $movement = move_uploaded_file($_FILES['photo']['tmp_name'], $img);
        }
        return $error;
    }
}