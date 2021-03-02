<?php
$error1 ='';
$errorBgColor = '';

//check for submit
if (filter_has_var(INPUT_POST, 'submit')) {
    //get the data from the user
    $name = htmlspecialchars($_POST['Fname']);
    $email = htmlspecialchars($_POST['Email']);
    $message = htmlspecialchars($_POST['message']);

    //validate all fields
    if (!empty($name) && !empty($email) && !empty($message)) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error1 = "Invalid email address";
            $errorBgColor = "red";
        } else {
            $error1 = "Successful!";
            $errorBgColor = "green";

            //add the recipient email address
            $RecipientEmail = 'evangelize4me@gmail.com';
            $subject = 'Contact request from'.$name;
            $body = '<h2>Contact Request</h2>
            <h4>Name</h4><p>'.$name.'</p>
            <h4>Email Address</h4><p>'.$email.'</p>
            <h4>Message</h4><p>'.$message.'</p>';

            //set headers
            $headers = "MIME-Version: 1.0" ."\r\n";
            $headers .="Content-Type:text/html; charset=UTF-8"."\r\n";

            //additional header
            $headers .="From: ".$name."<".$email.">"."\r\n";
            if (mail($RecipientEmail, $subject, $body, $headers)) {
                $error1 = "Email sent succesfully!.";
                $errorBgColor = "green";
            } else {
                $error1 = "Please your email was not sent.";
                $errorBgColor = "red";
            }
        }
    } else {
         $error1 = "Please fill all fields correctly.";
         $errorBgColor = "red";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>PHP FORM</title>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="form_container">
                <?php if($error1 !=''): ?>
                    <div> </div>
                <?php endif; ?>
                <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form_inputs">
                        
                        <div>
                            <label for="">Full Name</label>
                            <input type="text" name="Fname" id="" value="<?php echo (isset($_POST['Fname'])) ? $name: ''; ?>">
                        </div>

                        <div>
                            <label for="">Email Address</label>
                            <input type="text" name="Email" id="" value="<?php echo (isset($_POST['Email'])) ? $email: ''; ?>">
                        </div>

                        <div>
                            <label for="">Message</label>
                            <textarea name="message" id="" cols="30" rows="10" value=""><?php echo (isset($_POST['message'])) ? $message: ''; ?></textarea>
                        </div>
                    </div>

                    <div class="sub_btn">
                        <button name="submit" type="submit">Click to Submit</button>
                        <p class="<?php echo $errorBgColor; ?>"> <?php echo $error1; ?></p>
                    </div>
                </form>
            </div>
        </div>
    
    </div>

    
</body>
</html>


