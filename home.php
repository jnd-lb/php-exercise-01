<?php


$fullName_error="";
$fullName_error="";
$userName_error="";
$email_error="";
$phoneNumber_error="";
$socialSecurityNumber_error="";
$login_error="";

if(isset($_POST["submitLogRegister"])){
    require 'user.php';
       
        $validty=true;

        
        $fullName                 = filter_var($_POST["fullName"],FILTER_SANITIZE_STRING);
        $email                    = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
        $userName                 = filter_var($_POST["userName"],FILTER_SANITIZE_STRING);
        $password                 = filter_var($_POST["password"],FILTER_SANITIZE_SPECIAL_CHARS);
        $phoneNumber              = filter_var($_POST["phoneNumber"],FILTER_SANITIZE_SPECIAL_CHARS);
        $socialSecurityNumber     = filter_var($_POST["socialSecurityNumber"],FILTER_SANITIZE_NUMBER_INT);
  

        if(!preg_match("/^([a-zA-Z' ]+)$/",$fullName)){
            $validty=false;
            $fullName_error="there's an error in your input";
        }
        
        if(!preg_match("/^([a-zA-Z_]+)$/",$userName)){
            $validty=false;
            $userName_error="there's an error in your input";
        }

        if(isExist($userName)){
            $validty = false;
            $userName_error="User Name alredy existed";
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $validty=false;
            $email_error="there's an error in your input";
        }
         
        if(!preg_match("/^([a-zA-Z_0-9$_]+){6,}$/",$password)){
            $validty=false;
            $password_error="there's something wrong with your password make sure you used at least valid character ";
        }

        if(!preg_match("/^([a-zA-Z_0-9]+){6,}$/",$phoneNumber)){
           
            $validty=false;
            $phoneNumber_error="there's an error in your input";
        }

        if(!filter_var($socialSecurityNumber,FILTER_SANITIZE_NUMBER_INT)){
            $validty=false;
            $socialSecurityNumber_error="there's an error in your input";
        }

        if($validty){
            addUser([$userName=>$password]);
            header("Location: http://".$_SERVER['HTTP_HOST']."/safe.php");
            exit;
        }else{
        }
        
    }

    if(isset($_POST["sumbitLogin"])){
    require 'user.php';
      
        $userName_login                 = filter_var($_POST["userName_login"],FILTER_SANITIZE_STRING);
        $password_login                 = filter_var($_POST["password_login"],FILTER_SANITIZE_SPECIAL_CHARS);
      echo $password_login."---".$userName_login;
        if(isExistUser($userName_login,$password_login)){
            header("Location: http://".$_SERVER['HTTP_HOST']."/safe.php");
            exit;
        }else{
            $login_error="the username not exist or the password you entered is wrong";
        }
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/part1.css">
    <script src="./script.js"></script>
</head>
<body>

<style>
    .error{
        display:block;
        color:red;
    }
</style>
    <main>
     <div>
 
     <section class="registration">
            
            <div class="header">
            <h1>Register:</h1>
            </div>
            <form action="" method="post">
                <div>
                    <label for="fullName">Full Name:</label>
                    <input  type="text" id="fullName" name="fullName" required>
                    <span id="fullName_error" class="error">
                        <?php echo $fullName_error ?>
                    </span>
                </div>
                <div>
                    <label for="userName">Username:</label>
                    <input  type="text" id="userName" name="userName" required>
                    <span id="userName_error" class="error">
                    <?php echo $userName_error ?>
                    </span>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input  type="email" id="email" name="email" required>
                    <span id="email_error" class="error">
                    <?php echo $email_error ?>
                    </span>
                </div>


                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <span id="password_error" class="error">
                    <?php echo $password_error ?>
                
                    </span>
                </div>

                <div>
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <span id="confirmPassword_error" class="error"></span>
</div>

<div>
    <label for="phoneNumber">Phone:</label>
    <input type="tel" id="phoneNumber" name="phoneNumber" required>
    <span id="phoneNumber_error" class="error">
    <?php echo $phoneNumber_error ?>
    </span>
</div>

<div>
    <label for="birthDate">Date Of Birth:</label>
    <input type="date" id="birthDate" name="birthDate" required>
    <span id="birthDate_error" class="error"></span>
</div>

<div>
    <label for="socialSecurityNumber">SSN:</label>
    <input type="number" id="socialSecurityNumber" name="socialSecurityNumber" required>
    <span id="socialSecurityNumber_error" class="error">
    <?php echo $socialSecurityNumber_error ?>

    </span>
</div>

<div>
    <input type="submit" name="submitLogRegister" value="Register" >
</div>
            </form>
        </section>
        
        <section class="login">
            <div class="header">
                <h1>Login</h1>
            </div>
            <form method="post" action="">
                <span class="error">
                    <?php echo $login_error?>
                </span>
                <div>
                    <label for="userName_login">Username</label>
                    <input type="text" name="userName_login" id="userName_login" required>
                </div>
                <div>
                    <label for="password_login">password</label>
                    <input type="password" name="password_login" id="password_login" required>
                </div>
                <input type="submit" name="sumbitLogin" value="Login">
            </form>
        </section>
     </div>  
    </main>

</body>
</html>
