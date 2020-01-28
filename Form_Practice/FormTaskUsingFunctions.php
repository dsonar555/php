<?php
    require_once 'set_get_sessionValues.php'
?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div>
            <form method="POST">
                <div id="account">
                    <fieldset>
                        <legend>Account Information</legend>
                        <div>
                            <?php $prefix=['Mr', 'Mrs', 'Ms', 'Dr']; ?>
                            <label>Prefix:</label><br>
                            <select name="account[prefix]">
                            <?php
                                foreach ($prefix as $value) :
                                $selected = (getSessionValues('account','prefix') == $value) ? 'Selected' : ""; 
                            ?>
                                <option value="<?= $value?>" <?= $selected?>><?= $value?></option>
                            <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                        <div>
                            <label>First Name:</label><br>
                            <input type="text" name="account[firstName]" value="<?= getSessionValues('account','firstName')?>">
                            <span><?php
                            if(array_key_exists('firstName',$error_array)) :
                                echo $error_array['firstName']; 
                            endif;
                            ?></span>
                        </div>
                        <div>
                            <label>Last Name:</label><br>
                            <input type="text" name="account[lastName]" value="<?= getSessionValues('account','lastName')?>">
                        </div>
                        <div>
                            <label>Birth Date:</label><br>
                            <input type="date" name="account[birthDate]" value="<?= getSessionValues('account','birthDate')?>">
                        </div>
                        <div>
                            <label>Mobile No.:</label><br>
                            <input type="text" name="account[mobileNo]" value="<?= getSessionValues('account','mobileNo')?>">
                        </div>
                        <div>
                            <label>Email:</label><br>
                            <input type="text" name="account[email]" value="<?= getSessionValues('account','email')?>">
                        </div>
                        <div>
                            <label>Password:</label><br>
                            <input type="password" name="account[password]" value="<?= getSessionValues('account','password')?>">
                        </div>
                        <div>
                            <label>Confirm Password:</label><br>
                            <input type="password" name="account[confirmPassword]" value="<?= getSessionValues('account','confirmPassword')?>">
                        </div>
                    </fieldset>
                </div>
                <div id="address">
                    <fieldset>
                        <legend>Address Information</legend>
                        <div>
                            <label>Address Line 1:</label><br>
                            <input type="text" name="address[addressLine1]" value="<?= getSessionValues('address','addressLine1')?>">
                        </div>
                        <div>
                            <label>Address Line 2:</label><br>
                            <input type="text" name="address[addressLine2]" value="<?= getSessionValues('address','addressLine2') ?>">
                        </div>
                        <div>
                            <label>Company:</label><br>
                            <input type="text" name="address[company]" value="<?= getSessionValues('address','company')?>">
                        </div>
                        <div>
                            <label>City:</label><br>
                            <input type="text" name="address[city]" value="<?= getSessionValues('address', 'city')?>">
                        </div>
                        <div>
                            <label>State:</label><br>
                            <input type="text" name="address[state]" value="<?= getSessionValues('address','state')?>">
                        </div>
                        <div>
                            <?php $countries = ['India', 'China', 'Canada', 'Nepal', 'Brazil'];
                            ?>
                            <label>Country:</label><br>
                            <select name="address[country]">
                            <?php 
                                foreach ($countries as $aCountry) :
                                    $selected = (getSessionValues('address','country') == $aCountry) ? "Selected" : "";
                                ?>
                                <option value="<?= $aCountry?>"<?= $selected?>><?= $aCountry?></option>
                                <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                        <div>
                            <label>Postal Code</label><br>
                            <input type="text" name="address[postalCode]" value="<?=getSessionValues('address','postalCode')?>">
                        </div>
                    </fieldset>
                </div>
                <div>
                    <input type="checkbox" name="otherInformation" onclick="displayOtherInformation()">Other Information<br><br>
                </div>
                <div id="otherInformation">
                    <fieldset>
                        <legend>Other Information</legend>
                        <div>
                            <label>Decsribe Yourself:</label><br>
                            <textarea rows="5" cols="30" name="other[aboutYourself]"><?= getSessionValues('other','aboutYourself')?></textarea>
                        </div>
                        <div>
                            <label>Profile Image:</label><br>
                            <input type="file" name="other[profileImage]">
                        </div>
                        <div>
                            <label>Certificate:</label><br>
                            <input type="file" name="other[certificate]">
                        </div>
                        <div>
                            <?php 
                            $businessYears = ['Under 1 Year', '1-2 Years', '2-5 Years', '5-10 Years', 'Over 10 Years'];
                            ?>
                            <label>How long have you been in business?</label><br>
                            <?php foreach ($businessYears as $year) : 
                                $checked = (getSessionValues('other','businessYear') == $year) ? 'checked' : ''; 
                            ?>
                            <input type="radio" name="other[businessYear]" value="<?= $year?>" <?=$checked?>><?=$year?><br>
                            <?php endforeach ?>
                        </div>
                        <div>
                            <label>Number of clients you see each week?</label><br>
                            <select name="numberOfClients">
                                <?php 
                                    $numberOfClients = ['1-5', '6-10', '11-15', '15+'];
                                    foreach ($numberOfClients as $clients):
                                    $selected = (getSessionValues('other','numberOfClients')) ? 'selected' : '' ;
                                ?>
                                <option value="<?=$clients?>" <?=$selected?>><?=$clients?></option>
                                <?php
                                    endforeach;
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>How do you like us to get in touch with you?</label><br>
                            <?php 
                            $contactMedium = ['Post', 'Email', 'SMS', 'Phone'];
                            $checkedMediums = getSessionValues('other','contactMedium',[]);
                            foreach ($contactMedium as $medium) :
                            $checked = (in_array($medium,$checkedMediums)) ? 'checked' : '';
                            ?>
                            <input type="checkbox" name="other[contactMedium][]" value="<?=$medium?>" <?=$checked?>><?=$medium?><br>
                            <?php endforeach; ?>
                        </div>
                        <div>
                            <label>Hobbies:</label><br>
                            <select name="other[hobbies][]" multiple>
                            <?php
                                $hobbies = ['Listening to Music', 'Blogging', 'Travelling', 'Art','Sports']; 
                                $selectedHobbies = getSessionValues('other','hobbies');
                                foreach ($hobbies as $aHobby) : 
                                    $selected = (in_array($aHobby,$selectedHobbies)) ? 'Selected' : '';
                            ?>
                                <option value="<?=$aHobby?>"<?= $selected?>><?=$aHobby?></option>
                            <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                    </fieldset>
                </div>
                <div>
                    <br><input type="submit" value="Submit" name="submit">
                </div>
            </form>
        </div>
        <script src="formForInformations.js"></script>
    </body>
</html>