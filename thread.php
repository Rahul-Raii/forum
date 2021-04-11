<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <title>idiscuss- coding forum</title>
  </head>
  <body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    
    <?php 
    $id= $_GET['catid'];
    $sql= "SELECT * FROM `categories` WHERE cat_id=$id"; 
    $result= mysqli_query($conn, $sql);
    while($row= mysqli_fetch_assoc($result)){
    $catname= $row['cat_name'];
    $catdesc= $row['cat_desc'];
    }
    ?>

    <?php
    $showAlert=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
      $th_title= $_POST['title'];
      $th_desc= $_POST['desc'];
      $sl=$_POST['sl'];
      
      $sql="INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `time`) VALUES ('$th_title', '$th_desc', '$id', '$sl', current_timestamp())";
      $result= mysqli_query($conn, $sql);
      $showAlert=true;
    }
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success !! </strong> Your Record Has Been Inserted.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    ?>

    <div class="container text-center my-4">
    <div class="card">
  <h5 class="card-header bg-success">Welcome to <?php echo $catname; ?> Forum</h5>
  <div class="card-body">
    <p class="card-text"><?php echo $catdesc; ?></p>
    <a href="#" class="btn btn-outline-success">Learn More</a>
  </div>
</div>
  </div>

<?php

if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
  echo  '<div class="container">
  <h1>Ask a Question</h1>
  <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Problem Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailhelp">
    <small id="emailhelp" class="form-text text-muted">keep your text as short and crisp as possible else.</small>
  </div>
  <input type="hidden" name="sl" value="'.$_SESSION['sl'].'">
  <div class="form-group">
  <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
  <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
</div>
  <button type="submit" class="me-2 btn btn-success">Submit</button>
</form>
</div>';
}
else {
echo '<div class="container">
<h1>Ask a Question</h1>
You are not logged in
</div>';
}
?>


<div class="container py-2">
  <h1>Browse Query</h1>
   
  <?php 
    $id= $_GET['catid'];
    $sql= "SELECT * FROM `thread` WHERE thread_cat_id=$id"; 
    $result= mysqli_query($conn, $sql);
    $noResult=true;
    while($row= mysqli_fetch_assoc($result)){
    $noResult=false;
    $id= $row['thread_id'];
    $title= $row['thread_title'];
    $desc= $row['thread_desc'];
    $thread_time=$row['time'];
    $thread_user_id=$row['thread_user_id'];
    $sql2="SELECT user_email FROM `user` WHERE sl=$thread_user_id";
    $result2= mysqli_query($conn, $sql2);
    $row2= mysqli_fetch_assoc($result2);

  echo '<div class="card" style="width: 18rem;">
  <div class="card-body my-3">
  <img src="user_image.jpg" width="54px" class="mr-3" alt="logo">'.'
    <h5 class="card-title"><a href="threads.php?threadid=' .$id. '">'.$title.'</a></h5>
    '.$desc.'
     </div>'.'<p class="font-weight-bold my-0">Asket by : <b>'.$row2['user_email'].' at '.$thread_time.'</b></p>'.'
</div>';

}
if($noResult){

echo '<div class="jumbotron jumbotron-fluid">
<div class="container">
  <p class="display-4">No Threads Found </p>
  <p class="lead"><b><b>Be The First To Ask a Question</b></b></p>
</div>
</div>';
}
?>

  
  </div>
    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>