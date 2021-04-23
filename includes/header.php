<!-- the head section -->
<head>
<title>My PHP CRUD App</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</style>	
<!-- a helper script for validating the form-->
<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>
</head>

<!-- the body section -->
<body>
<header><h1>The Olympics</h1>
<div class="topnav">
  <a class="active" href="index.php">Home</a>
  <?php
  session_start();
  if(isset($_SESSION['user_id']) && ($_SESSION['user_id']) == 1){
    echo'  
  <a href="add_record_form.php">Add Athlete</a>
  <a href="manage.php">Manage</a>
  <a href="user_table.php">Users</a>
  ';
  }?>

  <a href="contact.php">Contact</a>
  <?php
if(!isset($_SESSION['user_id'])){
  echo'
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  ';
}?>
<?php
if(isset($_SESSION['user_id'])){
  echo'
  <a href="logout.php">Logout</a>';
}?>

</div>
</header>

