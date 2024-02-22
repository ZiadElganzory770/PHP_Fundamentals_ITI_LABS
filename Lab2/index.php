<?php 
    require_once 'vendor/autoload.php';
?>

<html>
    <head>
        <title> contact form </title>


    </head>

    <body>

        <?php
            $nameError = $emailError = $messageError = "";
            $name = $email = $message = "";
            $messageLength = 255;
            $submitted = false;

            //Sanitizing Input Data
            function sanitize_data($data){
                $data = trim($data);
                $data = stripcslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            //Form Submission Handling

            if($_SERVER["REQUEST_METHOD"]=="POST"){
                //Name Validation
                if(empty($_POST["name"])){
                    $nameError= "Name is Required!";
                } else {
                    $name = sanitize_data($_POST["name"]);

                    //Regex Validation

                    if(!preg_match("/^[a-zA-Z ]*$/",$name)){
                        $nameError = "Letters and White Spaces only are allowed !";
                    }
                }

                //Email Validation

                if(empty($_POST["email"])){
                    $emailError = "Email is Required !";
                } else {
                    $email = sanitize_data($_POST["email"]);
                    //Check For Email Format
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $emailError = "Invalid Email Format!";
                    }
                }

                //Message Validation
                if(empty($_POST["message"])){
                    $messageError = "Message Is Required";
                } else {
                    if(strlen($_POST["message"]) < $messageLength){
                        $message = sanitize_data($_POST["message"]);
                    } else {
                        $messageError = "Message Should be less than $messageLength";

                    }
                }

                //Form Submitted?

                if(empty($nameError) && empty($emailError) && empty($phoneError)){
                    $submitted = true;

                    if ($submitted) {
                        echo "<h2>Thanks for Contacting Us ! </h2>";
                        echo "<b>Name: </b>" . $name . "<br>";
                        echo "<b>Email: </b>" . $email . "<br>";
                        echo "<b>Message: </b>" . $message . "<br>";
                        echo "<br><br>";
                        

                        if(store_file($name,$email)){
                            die("Contact Saved Sucessfully"."<br/> To Visit all contacts <a href='data.php?view=display'>CLick Here</a>");
                        } else {
                            die("Error Saving Contact");
                        }
                    }

                }
            }
            
        ?>


        <h3> Contact Form </h3>

        <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" type="text" value="<?php echo $name; ?>" size="30" /><br />
                <span class="error"><?php echo $nameError; ?></span>
            </div>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" type="text" value="<?php echo $email; ?>" size="30" /><br />
                <span class="error"><?php echo $emailError; ?></span>
            </div>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message" rows="7" cols="30"><?php echo $message; ?></textarea><br />
                <span class="error"><?php echo $messageError; ?></span>
            </div>

            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />

        </form>

        <div id="after_submit">
            <?php

            ?>
        </div>
    </body>

</html>