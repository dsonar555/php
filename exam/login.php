<?php
    require_once 'operations.php';
?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div>
            <fieldset>
                <legend>Login</legend>
                <form method="POST">
                    <div>
                        <div>
                            <label>Email:</label><br>
                            <input type="text" name="email"  required>
                            <?php if(!empty($error_array['email'])) 
                                echo $error_array['email'];
                            ?>
                        </div>
                        <div>
                            <label>Password:</label><br>
                            <input type="password" name="password" required>
                        </div><br>
                        <div>
                            <input type="submit" name="login" value="Login">
                        </div>
                    </div><br>
                </form>
                <div>
                    <a href="registration.php"><button>Register</button></a>
                </div>
            </fieldset>
        </div>
    </body>
</html>