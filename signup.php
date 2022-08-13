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


if(isset($_POST['submit1'])){
    $Fname= $_POST['Fname'];
    $Lname= $_POST['Lname'];
    $UserID= $_POST['UserID'];
    $pass= $_POST['pass'];
    $email= $_POST['email'];

    $count1=0;

    $sql2= "SELECT * FROM register where UserID='$UserID'";
    $res1= $conn->query($sql2);
    if($res1->rowCount()>0){
        $count1=1;
    }

    if($count1==0){
        if(!empty($Fname) && !empty($Lname) && !empty($UserID) && !empty($pass) &&  !empty($email)){
            $sql= "INSERT INTO register(First_Name,Last_Name,UserID,Password,Email)
            VALUES ('$Fname','$Lname','$UserID','$pass','$email')";
            $conn-> exec($sql);
            header('location:home.php');
            $_SESSION['$userID']= $userID;
        }
        else{
            header('location:signup.php?fill');
        }
    }
    else{
        header('location:signup.php?exist');
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
    <title>Welcome to Sign Up Page</title>
    <style>
         .msg1{
            color: red;
         }
    </style>
</head>

<body>


    <div class="div2">

        <img src="barbarlogo.webp">

        <form action="" method="POST"> <div class="inputbox-div">


            <h2>ELEGANT MIRROR</h2>
            <hr>

            <h3>Register</h3>

            <h4>First Name:</h4>

            <input type="text" placeholder="   First Name" name="Fname" size="40"><br>

            <h4>Last Name:</h4>

            <input type="text" placeholder="   Last Name" name="Lname" size="40"><br>

            <h4>UserID:</h4>

            <input type="text" placeholder="  UserID" name="UserID" size="40"><br>

            <h4>PASSWORD:</h4>

            <input type="password" name="pass" size="40" placeholder="password">

            <h4>Email:</h4>

            <input type="text" placeholder="  Email/Mobile" name="email" size="40"><br>

            <div class="msg1">
            <?php
                $msg="";
                if(isset($_GET['fill'])){
                    $msg="**Fill Up**";
                    echo $msg;
                }
            ?>

            <div class="msg1">
                        <?php
                            $msg="";
                            if(isset($_GET['exist'])){
                                $msg="**User Name Already Exist**";
                                echo $msg;
                            }
                        ?>
                </div>
    </div>
            <p></p><br>
            <input type="submit" name="submit1" value="Register">
            


        </div></form>

    </div>

</body>

</html>