<script>
function phonenumber(inputtxt)
{
  var phoneno = /^\d{10}$/;
  if((inputtxt.value.match(phoneno))
        {
      return true;
        }
      else
        {
        alert("message");
        return false;
        }
}

function validateForm(){
    var nameRegex = /^[a-zA-Z\-]+$/;
    var validfirstUsername = document.frm.firstName.value.match(nameRegex);
    if(validUsername == null){
        alert("Your first name is not valid. Only characters A-Z, a-z and '-' are  acceptable.");
        document.frm.firstName.focus();
        return false;
    }
</script>
<?php

//register.php

/**
 * Include ircmaxell's password_compat library.
 */
require 'libary-folder/password.php';

/**
 * Include our MySQL connection.
 */
require 'login_connect.php';

?>
<div class="container">

<!DOCTYPE html>
<?php
include('includes/header.php');
?>

<?php
//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['register'])){
    $errors = '';
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    // if (!preg_match(
    //     "/^.{3,32}$/i", 
    //     $username))
    //     {
    //         $errors .= "\n Error: Invalid username";
    //     }

    // function isNameValid($username) { 
    //     $pattern = '/^[A-Za-z]+/'; 
    //     if (preg_match($pattern, $username)) {
    //         return true; 
    //     } 
    //     return false; 
    // }

    // if (!preg_match(
    //     "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/i", 
    //     $phone))
    //     {
    //         $errors .= "\n Error: Invalid phone number";
    //     }
    //the prepared statement is built and executed.

        
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That username already exists!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO users (username, phone, password) VALUES (:username, :phone, :password)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':password', $passwordHash);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo 'Thank you for registering with our website.';
        header('Location: login.php');
        exit;
    }
    
}

?>

<!DOCTYPE html>
        <h1>Register</h1>
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input /*pattern = "/^[A-Za-z]+/"*/ type="text" id="username" name="username" required><br>
            <label for="phone">Phone</label>
            <input /*pattern = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/i/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/i"*/ type="text" id="phone" name="phone" required><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" required><br>
            <input type="submit" name="register" value="Register"></button>
        </form>
        <script language="JavaScript">
	var frmvalidator  = new Validator("register");
	frmvalidator.addValidation("name","req","Please provide your name"); 
	frmvalidator.addValidation("phone","req","Please provide your phone"); 
	frmvalidator.addValidation("email","email","Please enter a valid email address"); 
	</script>
        <?php
include('includes/footer.php');
?>