 <?php
 include '_dbconnect.php';
session_start();
echo '   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
    
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        
        $sql="SELECT * FROM `categories` LIMIT 3";
        $result= mysqli_query($conn, $sql);
        while($row= mysqli_fetch_assoc($result)){
          echo '<a class="dropdown-item" href="thread.php?catid='.$row['cat_id'].'">'.$row['cat_name'].'</a>';
        }
      echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" tabindex="-1">Contact</a>
      </li>
    </ul>';
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
      echo '<form class="d-flex" method="get" action="search.php">
      <input class="form-control me-2" name="search"  type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    <p class="text-light my-0 mx-2"> Welcome '.$_SESSION['useremail'].' </p>
    <a href="partials/_logout.php" class=" mx-1 btn btn-success">Logout</a>
    </form>';
    }

   else{  echo '<form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <button class="mx-2 btn btn-success"data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
    
    <button class="mx-0 btn btn-success"data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>';
   }
   
   echo  '</div>
    </div>
</nav>';

include 'partials/_login.php';
include 'partials/_signup.php';
if(isset($_GET['signupsuccess'])&& $_GET['signupsuccess']=="true"){
 echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfully Signup !!</strong> Enjoy The Forum.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>