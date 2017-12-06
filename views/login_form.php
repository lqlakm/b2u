<?php
    if ($login->errors) {
        foreach ($login->errors as $error) {
        echo $error;          
        }
    }

    if ($login->messages) {
        foreach ($login->messages as $message) {
         echo $message;
        }
    }

?>
 		<div>
 			<form method="post" action="index.php" name="loginform">
                <input name="c_email" size="16" type="text" placeholder="Email" required/><br/>
                <input name="c_password" autocomplete="off" size="16" type="password" placeholder="Password" required/><br/>

                
            <button type="submit" name="login">Login</button>
        	</form>
            <br/>

            <a href = "customer_register.php">Register new account</a>
        </div>
