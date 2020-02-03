<?php
    require_once 'operations.php';
?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div>
            <form method="POST">
                <div>
                    <fieldset>
                        <legend>Registration</legend>
                        <div>
                            <?php $prefix=['Mr', 'Mrs', 'Ms', 'Dr']; ?>
                            <label>Prefix:</label><br>
                            <select name="user[prefix]">
                            <?php
                                foreach ($prefix as $value) :
                                $selected = (getValues('user','prefix') == $value) ? 'selected' : ""; 
                            ?>
                                <option value="<?=$value?>"<?=$selected?>><?= $value?></option>
                            <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                        <div>
                            <label>First Name:</label><br>
                            <input type="text" name="user[first_name]" value="<?=getValues('user','first_name')?>" required>
                            <span><?php
                            // if(array_key_exists('firstName',$error_array)) :
                            //     echo $error_array['firstName']; 
                            // endif;
                            ?></span>
                        </div>
                        <div>
                            <label>Last Name:</label><br>
                            <input type="text" name="user[last_name]" value="<?=getValues('user','last_name')?>" required>
                        </div>
                        <div>
                            <label>Mobile No.:</label><br>
                            <input type="text" name="user[mobile_no]" value="<?=getValues('user','mobile_no')?>" required>
                        </div>
                        <div>
                            <label>Email:</label><br>
                            <input type="text" name="user[email]" value="<?=getValues('user','email')?>" required>
                        </div>
                        <?php if(!isset($_GET['user_id'])):?>
                        <div>
                            <label>Password:</label><br>
                            <input type="password" name="user[password]" value="<?=getValues('user','password')?>" required>
                        </div>
                        <div>
                            <label>Confirm Password:</label><br>
                            <input type="password" name="user[confirmPassword]" value="<?=getValues('user','password')?>" required>
                        </div>
                        <?php endif;?>
                        <div>
                            <label>Information:</label><br>
                            <textarea rows="6" cols="40" name="user[information]"><?=getValues('user','information');?></textarea>
                        </div>
                        <?php if(!isset($_GET['user_id'])):?>
                        <div>
                            <input type="checkbox" name="user['terms']" required="">
                            Hereby, I accept terms and conditions.
                        </div>
                        <?php endif;?>
                    </fieldset>
                </div>
                <?php 
                    if(!isset($_GET['user_id'])) :
                ?>
                <div>
                    <br><input type="submit" value="Register" name="register">
                </div>
                <?php 
                    endif;
                ?>
                <?php
                if(isset($_GET['user_id'])) :
                    ?>
                    <div><input type="submit" value="Edit" name="edit"></div>
                    <?php
                endif; 
                ?>
            </form>
        </div>
    </body>
</html>