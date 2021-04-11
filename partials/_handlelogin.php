<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpass'];
    
    $sql= "SELECT * FROM user WHERE user_email= '$email'";
    $result= mysqli_query($conn, $sql);
    $numRows= mysqli_num_rows($result);
   if($numRows==1){
        $row= mysqli_fetch_assoc($result);
        echo $row['user_pass']; 
        echo "</br>";
        echo $pass;
            if(password_verify($pass, $row['user_pass'])){
             //if($pass==$row['user_pass']){   
                echo 'ANDRRR';
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['sl']=$row['sl'];
                $_SESSION['useremail']=$email;
                echo 'logged in';
            }
            header("Location: /forum/index.php");
    }


}
?>