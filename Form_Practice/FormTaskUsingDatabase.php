<?php
    require_once 'set_get_databaseData.php'
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
                                $selected = (getValues('account','prefix') == $value) ? 'selected' : ""; 
                            ?>
                                <option value="<?=$value?>"<?=$selected?>><?= $value?></option>
                            <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                        <div>
                            <label>First Name:</label><br>
                            <input type="text" name="account[firstName]" value="<?=getValues('account','firstName')?>" required>
                            <span><?php
                            // if(array_key_exists('firstName',$error_array)) :
                            //     echo $error_array['firstName']; 
                            // endif;
                            ?></span>
                        </div>
                        <div>
                            <label>Last Name:</label><br>
                            <input type="text" name="account[lastName]" value="<?=getValues('account','lastName')?>" required>
                        </div>
                        <div>
                            <label>Birth Date:</label><br>
                            <input type="date" name="account[birthDate]" value="<?=getValues('account','birthDate')?>">
                        </div>
                        <div>
                            <label>Mobile No.:</label><br>
                            <input type="text" name="account[mobileNo]" value="<?=getValues('account','mobileNo')?>" required>
                        </div>
                        <div>
                            <label>Email:</label><br>
                            <input type="text" name="account[email]" value="<?=getValues('account','email')?>" required>
                        </div>
                        <div>
                            <label>Password:</label><br>
                            <input type="password" name="account[password]" value="<?=getValues('account','password')?>" required>
                        </div>
                        <div>
                            <label>Confirm Password:</label><br>
                            <input type="password" name="account[confirmPassword]" value="<?=getValues('account','password')?>" required>
                        </div>
                    </fieldset>
                </div>
                <div id="address">
                    <fieldset>
                        <legend>Address Information</legend>
                        <div>
                            <label>Address Line 1:</label><br>
                            <input type="text" name="address[addressLine1]" value="<?=getValues('address','address_line1')?>" required>
                        </div>
                        <div>
                            <label>Address Line 2:</label><br>
                            <input type="text" name="address[addressLine2]" value="<?= getValues('address','address_line2') ?>" required>
                        </div>
                        <div>
                            <label>Company:</label><br>
                            <input type="text" name="address[company]" value="<?= getValues('address','company')?>">
                        </div>
                        <div>
                            <label>City:</label><br>
                            <input type="text" name="address[city]" value="<?= getValues('address', 'city')?>" required>
                        </div>
                        <div>
                            <label>State:</label><br>
                            <input type="text" name="address[state]" value="<?= getValues('address','state')?>" required>
                        </div>
                        <div>
                            <?php $countries = ['India', 'China', 'Canada', 'Nepal', 'Brazil'];
                            ?>
                            <label>Country:</label><br>
                            <select name="address[country]" required>
                            <?php 
                                foreach ($countries as $aCountry) :
                                    $selected = (getValues('address','country') == $aCountry) ? "Selected" : "";
                                ?>
                                <option value="<?= $aCountry?>"<?= $selected?>><?= $aCountry?></option>
                                <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                        <div>
                            <label>Postal Code</label><br>
                            <input type="text" name="address[postalCode]" value="<?= getValues('address','postal_code')?>" required>
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
                            <textarea rows="5" cols="30" name="other[aboutYourself]" required><?= getValues('other','aboutYourself')?></textarea>
                        </div>
                        <!-- <div>
                            <label>Profile Image:</label><br>
                            <input type="file" name="other[profileImage]">
                        </div>
                        <div>
                            <label>Certificate:</label><br>
                            <input type="file" name="other[certificate]">
                        </div> -->
                        <div>
                            <?php 
                            $businessYears = ['Under 1 Year', '1-2 Years', '2-5 Years', '5-10 Years', 'Over 10 Years'];
                            ?>
                            <label>How long have you been in business?</label><br>
                            <?php foreach ($businessYears as $year) : 
                                $checked = (in_array($year,getValues('other','businessYear',[]))) ? 'checked' : ''; 
                            ?>
                            <input type="radio" name="other[businessYear]" value="<?= $year?>" <?=$checked?>><?=$year?><br>
                            <?php endforeach ?>
                        </div>
                        <div>
                            <label>Number of clients you see each week?</label><br>
                            <select name="other[numberOfClients]">
                                <?php 
                                    $numberOfClients = ['1-5', '6-10', '11-15', '15+'];
                                    foreach ($numberOfClients as $clients):
                                    $selected = (in_array($clients,getValues('other','numberOfClients',[]))) ? 'selected' : '' ;
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
                            $checkedMediums = getValues('other','contactMedium',[]);
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
                                $selectedHobbies = getValues('other','hobbies');
                                foreach ($hobbies as $aHobby) : 
                                    $selected = (in_array($aHobby,$selectedHobbies)) ? 'Selected' : '';
                            ?>
                                <option value="<?=$aHobby?>"<?=$selected?>><?=$aHobby?></option>
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