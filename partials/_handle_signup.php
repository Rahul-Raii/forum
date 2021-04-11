 <?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];

$exitsql= "select * from 'user' where user_email= '$user_email' ";
$result= mysqli_query($conn, $exitsql);
$numRows= mysqli_num_rows($result);
if($numRows>0){
    $showError= "Email already in use";
}
else{
    if($pass==$cpass){
        $hass= password_hash($pass, PASSWORD_DEFAULT);
       
        $sql= "INSERT INTO `user` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hass', current_timestamp())";
        $result= mysqli_query($conn, $sql);
        echo $result;
        if($result){
            $showAlert= true;
            header("Location: /forum/index.php?signupsuccess=true");
            exit();
        }
    }
    else{
        $showError= "Passwords Do not Match";
    }
}
header("Location: /forum/index.php?signupsuccess=false&error=$showError");

}

?>