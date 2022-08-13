<?php
$serverName= "localhost";
$username= "root";
$password= "";
$dbName= "barbarShop";
session_start();

try{
    $conn= new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected Succesfully";

}catch(PDOExpection $exc){
    echo "Connection Failed" .$exc->getmessage();
    exit();
}

if(isset($_POST['submit'])){
    $UserID= $_POST['UserID'];
    $Pass= $_POST['Pass'];

    if(!empty($UserID) && !empty($Pass)){
        $sql2= "SELECT * FROM register where UserID='$UserID' AND Password='$Pass'";
        $res= $conn->query($sql2);
        if($res->rowCount()> 0){
            header('location:index.php');
          
            $_SESSION['$userID']= $userID;
        }
        else{
            header('location:login.php?error');
        }
    }
    else{
        header('location:login.php?fill');
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Welcome to Login Page</title>

    <style>
         .msg1{
            color: red;
         }
    </style>
</head>

<body>

    <div class="div1">

        <img src="barbarlogo.webp">

        <form action="" method="POST"><div class="inputbox-div">

            <h2>Please Fill Up the Information Below to Login:</h2>
            <hr>

            <h3>Login</h3><br>

            <h4>USERNAME:</h4>

            <input type="text" placeholder="UserID" name="UserID" size="40"><br>

            <h4>PASSWORD:</h4>

            <input type="password" name="Pass" size="40" placeholder="Password">

            <div class="msg1">
            <?php
                $msg="";
                if(isset($_GET['error'])){
                    $msg="**Wrong UserID or Password**";
                    echo $msg;
                }
            ?>
        </div>

        <div class="msg1">
            <?php
                $msg="";
                if(isset($_GET['fill'])){
                    $msg="**Fill up**";
                    echo $msg;
                }
            ?>
        </div>
            <p></p><br>
            <input type="submit" name="submit" value="Login">

            <a href="signup.php" id="reff">For Sign-Up</a><br><br><br>
            <hr style="border: 0.5px solid grey;">
            <br>
            <h3>Please Click <a href="#" id="reff2">Here</a> To Clear Username And Password</h3>


        </div></form>


    </div>

</body>

</html>