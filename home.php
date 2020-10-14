<?php
    
    if(isset($_POST["submit"])){


	$filters = array(
		"data" => FILTER_VALIDATE_EMAIL,
		"date" => array(
			"filter" => FILTER_VALIDATE_INT,
			"options" => array(
				"min_range" => 18,
				"max_range" => 100
            ),
        "fullName" => 
		)
	);

	print_r(filter_input_array(INPUT_POST, $filters));

    }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>
<body>

<style>
    .error{
        display:none;
        color:red;
    }
</style>
    <main>
        <section class="login">
            <form action="" method="post">
                <label for="fullName">Full Name:</label>
                <input  type="text" id="fullName" name="fullName" required>
                <span id="fullName_error" class="error"></span>

                <label for="userName">Username:</label>
                <input  type="text" id="userName" name="userName" required>
                <span id="userName_error" class="error"></span>


                <label for="email">Email:</label>
                <input  type="email" id="email" name="email" required>
                <span id="email_error" class="error"></span>


                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span id="password_error" class="error"></span>


                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <span id="confirmPassword_error" class="error"></span>


                <label for="phoneNumber">Phone:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" required>
                <span id="phoneNumber_error" class="error"></span>


                <label for="birthDate">Date Of Birth:</label>
                <input type="date" id="birthDate" name="birthDate" required>
                <span id="birthDate_error" class="error"></span>


                <label for="socialSecurityNumber">Social Security Number:</label>
                <input type="number" id="socialSecurityNumber" name="socialSecurityNumber" required>
                <span id="socialSecurityNumber_error" class="error"></span>


                <input type="submit" name="submit" value="Register" >

            </form>
        </section>
        
        <section class="register">
        </section>
    </main>

</body>
</html>
