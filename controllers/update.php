<?php 
    include_once 'crud.php';
    include_once 'validation.php';
    include_once 'display.php';
    $con = mysqli_connect('localhost', 'root', '', 'winzelle');

    function updateCRUD($set, $from, $condition){
        return update("UPDATE $from SET $set WHERE $condition");
    }
    
    function ForgotPass($data){
        global $con;
        $email = mysqli_real_escape_string($con, $data['email']);
        $password = mysqli_real_escape_string($con, $data['new-password']);
        $confirm = mysqli_real_escape_string($con, $data['conf-password']);

        $error['err_email'] = emailExists($email);
        $error['err_pass'] = validatePassword($password);
        $error['err_cpass'] = validateConfirm($password, $confirm);
        return $error;
    }

    function changeEmail($data, $userID){
        global $con;
        $email = mysqli_real_escape_string($con, $data['email']);
        $password = mysqli_real_escape_string($con, $data['pass']);
        $confirm = mysqli_real_escape_string($con, $data['cpass']);

        $error['errChangeEmail'] = validateConfirm($password, $confirm);
        $error['err_email'] = validateEmail($email);
        
        if(!isset($error['err_pass']) && !isset($error['err_cpass'])){
            $encrypt = getData("userPassword", "user",  "userID LIKE '$userID'")[0];
            $encrypt = $encrypt['userPassword'];
            
            if($error['err_email'] == 'email already taken!') return $error['err_email'] = 'please try again!';
            if($error['err_email'] == 'invalid e-mail format!') return $error['err_email'] = 'please try again!';
            if(password_verify($password, $encrypt)){
                updateCRUD("userEmail = '$email'", "user", "userID LIKE '$userID'");
            }
            else return $error['errChangeEmail'] = 'please try again!';
        }
        else return $error;
    }

    function changeData($data, $userID){
        global $con;
        $profileExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $name = mysqli_real_escape_string($con, $data['name']);
        $address = mysqli_real_escape_string($con, $data['address']);
        $img = changeProfile("profile");

        
        if(isset($img) && count($img) == 0){
            $nameImg = accDate().'.'.$profileExtension;
            updateCRUD("userProfile = '$nameImg'", "user", "userID LIKE '$userID'");
        }
        updateCRUD("userName = '$name', userAddress = '$address'", "user", "userID LIKE '$userID'");
    }

?>