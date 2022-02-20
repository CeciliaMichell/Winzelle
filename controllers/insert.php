<?php 
    include_once 'validation.php';
    include_once 'display.php';
    include_once 'update.php';
    include_once 'crud.php';
    $con = mysqli_connect('localhost', 'root', '', 'winzelle');

    function cekDataRegist($data){
        global $con;
        $email = mysqli_real_escape_string($con, $data['email']);
        $name = mysqli_real_escape_string($con, $data['name']);
        $password = mysqli_real_escape_string($con, $data['password']);
        $confirm = mysqli_real_escape_string($con, $data['confirm']);

        $error['err_email'] = validateEmail($email);
        $error['err_uname'] = validateName($name);
        $error['err_pass'] = validatePassword($password);
        $error['err_cpass'] = validateConfirm($password, $confirm);
        return $error;
    }

    function insertData($data){
        global $con;

        $email = mysqli_real_escape_string($con, $data['email']);
        $username = mysqli_real_escape_string($con, $data['name']);
        $password = mysqli_real_escape_string($con, $data['password']);
        $address = mysqli_real_escape_string($con, $data['address']);
        $encrypt = password_hash($password, PASSWORD_DEFAULT);
        $slug = password_hash($email, PASSWORD_DEFAULT);

        $query = "INSERT INTO user(userEmail, userName, userPassword, userSlug, userAddress) VALUES('$email', '$username', '$encrypt', '$slug', '$address')";
        return create($query);
    }

    function cekDataLogin($data){
        global $con; 

        $email = mysqli_real_escape_string($con, $data['email']);
        $password = mysqli_real_escape_string($con, $data['password']);
        $user = getData("*", "user", "userEmail LIKE '$email'");
        if(count($user) != 0){
            $user = $user[0];
            $passHash = $user['userPassword'];
            if(password_verify($password, $passHash)){
                $_SESSION['login'] = true;
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['userLevel'] = $user['userLevel'];
                header("Location: ../index.php");
            }
            else return $error['err_login'] = 'please try again!';
        }
        else{
            return $error['err_login'] = 'email is not registered!';
        }
    }

    function ProductToCart($userID, $productID, $size, $qty){
        $query = "INSERT INTO cart(userID, productID, cartSize, cartQty) VALUES('$userID', '$productID', '$size', '$qty')";
        return create($query);
    }

    function cartToHistory($userID, $productID, $qty, $size, $payment, $courier, $date){
        $query = "INSERT INTO orders(productID, userID, orderQty, orderSize, orderPayment, orderCourier, orderDate) VALUES('$productID', '$userID', '$qty', '$size', '$payment', '$courier', '$date')";
        return create($query);
    }

    function addProduct($data){
        global $con;
        $profileExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $name = mysqli_real_escape_string($con, $data['name']);
        $category = mysqli_real_escape_string($con, $data['category']);
        $desc = mysqli_real_escape_string($con, $data['desc']);
        $price = $data['price'];
        $nameImg = accDate().'.'.$profileExtension;

        if(empty($name) || empty($category) || empty($desc) || empty($price) || empty($nameImg)) return $error['err_data'] = "fil out the form completely!";
        
        $img = changeProfile($category);
        if(count($img)) return $error['err_data'] = $img['err_data'];
        if(isset($img) && count($img) == 0){
            $query = "INSERT INTO product(productName, categoryID, productDesc, productPrice, productImage) VALUES('$name', '$category', '$desc', '$price', '$nameImg')";
            return create($query);
        }
        else return $img;
    }

    function addRating($data){
        global $con;
        $orderID = mysqli_real_escape_string($con, $data['submitReview']);
        $numb = mysqli_real_escape_string($con, $data['rating']);
        $desc = mysqli_real_escape_string($con, $data['desc']);

        $query = "INSERT INTO rating(orderID, ratingNumb, ratingDesc) VALUES('$orderID', '$numb', '$desc')";
        $rating = create($query);

        $ratingID = getData("ratingID", "rating", "orderID LIKE '$orderID' AND ratingNumb LIKE '$numb' AND ratingDesc LIKE '$desc'")[0];
        $ratingID = $ratingID['ratingID'];

        if($rating == 1){
            updateCRUD("ratingID = '$ratingID'", "orders", "orderID LIKE '$orderID'");
            return $ratingID;
        }
    }

    function addContact($data){
        global $con;
        $email = mysqli_real_escape_string($con, $data['email']);
        $name = mysqli_real_escape_string($con, $data['name']);
        $text = mysqli_real_escape_string($con, $data['text']);

        $query = "INSERT INTO contact(contactEmail, contactName, contactText) VALUES('$email', '$name', '$text')";
        return create($query);
    }

?>