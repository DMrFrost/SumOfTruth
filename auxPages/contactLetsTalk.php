<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Send Email</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Economica|Nunito|Orbitron|Tangerine|Ubuntu" rel="stylesheet"/>
    <link href="../ss/auxPages/contactEMail.css" type="text/css" rel="stylesheet"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php


      //Check if form has been submitted
      if($_POST['submit']){
        //define variables from user input $_POST array
        $subject = $_POST['subject'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        //define error variables and set to false
        $errors = false;
        $errorMessage = false;

        //check for subject
        if(!$subject){
          $errors .= '<p><strong>You forgot a subject!</strong></p>';
        }else{
          //sanitize subject
          $subjectFiltered = filter_var($subject, FILTER_SANITIZE_STRING);
        }
        //check for email
        if($email){
          //sanitize email
          $emailFiltered = filter_var($email, FILTER_SANITIZE_EMAIL);
        }if($email == 'anon' || $email == 'Anon' || $email == 'ANON'){
          //if user wishes to stay anonymous do nothing to error messages
            $nothing = 'nothin';
          }else if(!$email){
            //check if email is missing
            $errors .= '<p><strong>I cant respond without an email!  If you would like to be
            anonymous type "anon" into the field.</strong></p>';
          }else if(!filter_var($emailFiltered, FILTER_VALIDATE_EMAIL)){
            //check if email is formatted
            $errors .= '<p><strong>Your EMail is Invalid</strong></p>';
          }
          //check for message
          if(!$message){
            $errors .= '<p><strong>You have to say something to start a conversation :)</strong></p>';
          }else{
            //sanitize message
            $messageFiltered = filter_var($message, FILTER_SANITIZE_STRING);
          }
        //check for errors.  If present dump them into a div and pass to errorMessage
        if($errors){
          $errorMessage = "<div class='alert alert-danger'>$errors</div>";
        }

        //check for errors.  If no errors we will send email
        if(!$errors){
          //establish variables and subject modify tags
          //targer email address
          $sendTo = 'SumOfTruth@gmail.com';
          //subject with tag added
          $subjectToSend = '(TALK)' . $subjectFiltered;
          //basic html message
          $messageToSend = "
            <p><strong>From: </strong>$emailFiltered</p>
            <p><strong>Writes: </strong></p>
            <p>$messageFiltered</p>
          ";
          //header for html
          $headers = "Content-type:text/html";

          //send email
          if(mail($sendTo, $subjectToSend, $messageToSend, $headers)){
              //if success redirect user to thank you page
              //THIS CODE DOES NOT EXECUTE
            echo '<script>window.location = "'. 'contactLetsTalkSuccess.html' .'";</script>';
          }else{
            //if fail build an error message
            $errorMessage = "Looks like the servers won't let you do this at the moment.  Please try again later";
            $errorMessage = "<div class='danger alert-danger'>$errorMessage</div>";
          }
        }
            //display an error if true
        echo $errorMessage;
      }


    ?>

    <section class="mailDiv container-fluid" id="letsTalk">
      <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10">
          <h2>Lets Talk... About Anything.</h2><br>
          <div class="mailForm">
            <form method="post">
              <p>Subject</p>
              <input id="subject" name="subject" type="text" length="50px" placeholder="Subject" value="<?php echo $_POST['subject'] ?>"/><br>
              <p>Your Email</p>
              <input id="email" name="email" type="text" placeholder="Return @ddress" length="30" value="<?php echo $_POST['email'] ?>"/><br>
              <p>Messege</p>
              <textarea id="message" class="col-xs-offset-1 col-xs-10" name="message" rows="13" placeholder="Say what you want" length="5000"><?php echo $_POST['message']?></textarea><br>
              <input id="submit" type="submit" name="submit" value="Send" onclick="contactLetsTalk_send()">
            </form>
          </div>
        </div>
      </div>
    </section>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

  </body>
</html>
