<?php
//this file is set up to submit offer Shelter Form and to pass all data into mySQL database
include ('linkConfig.php');

function linkDB(){
  $link = new mysqli(SERVER_NAME, USER_NAME, PWD, DB_NAME);
  // Check connection
  if ($link->connect_error) {
     die("Connection failed: " . $link->connect_error);
  }
  return $link;
}

function queryDB(){

}

function submitDB($link){
  //variable to hold relavent error messages.  Set to false
    $error = false;
  //Place possible error messages in variables
    $missingTitle = "<p>Missing Title</p>";
    $missingGeo = "<p>Missing GeoCoordinates</p>";
    $missingPContact = "<p>Please enter your Email or Phone</p>";
    $invalidPEmail = "<p>Please enter a valid Email for yourself</p>";
    $missingType = "<p>Missing \"Type\" of shelter</p>";
    $missingOContact = "<p>Missing Owner Contact Details</p>";
    $invalidOEmail = "<p>Please enter a valid Email for this location</p>";

  //Establish Variables from Post
    $title = $_POST['title'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
  //Poster Contact Group
    $pName = $_POST['pName'];
    $pEmail = $_POST['pEmail'];
    $pPhone = $_POST['pPhone'];
    $pContactPub = $_POST['pContactPub'];
  //Owner Contact Group
    $type = $_POST['type'];
    $oName = $_POST['oName'];
    $oEmail = $_POST['oEmail'];
    $oPhone = $_POST['oPhone'];
    $oContactPub = $_POST['oContactPub'];
  //Description Group
    $description = $_POST['description'];
    $descriptionPub = $_POST['descriptionPub'];

  //Check data fields
    if(!$title){
      $error .= $missingTitle;
    }else{
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $title = mysqli_real_escape_string($link, $title);
    }//Check for Grocoordinates
    if(!$lat || !$lng){
      $error .= $missingGeo;
    }//Check Personal Conatact
    if(!$pName || (!$pEmail && !$pPhone)){
      $error .= $missingPContact;
    }else{
      $pName = filter_var($pName, FILTER_SANITIZE_STRING);
      $pName = mysqli_real_escape_string($link, $pName);
      $pEmail = filter_var($pEmail, FILTER_SANITIZE_EMAIL);
      $pEmail = mysqli_real_escape_string($link, $pEmail);
      $pPhone = filter_var($pPhone, FILTER_SANITIZE_STRING);
      $pPhone = mysqli_real_escape_string($link, $pPhone);
    }
    //Check type
    if(!$type){
      $error .= $missingType;
    }else{
      if($type == "notOwner" || $type == "organization"){
        if(!$oName || (!$oEmail && !$oPhone)){
          $error .= $missingOContact;
        }else{
          $oName = filter_var($oName, FILTER_SANITIZE_STRING);
          $oName = mysqli_real_escape_string($link, $oName);
          $oEmail = filter_var($oEmail, FILTER_SANITIZE_EMAIL);
          $oEmail = mysqli_real_escape_string($link, $oEmail);
          $oPhone = filter_var($oPhone, FILTER_SANITIZE_STRING);
          $oPhone = mysqli_real_escape_string($link, $oPhone);
        }
      }
    }
    if($error){
      return $error;
      die();
    }
    //clean the messages
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $description = mysqli_real_escape_string($link, $description);

    //set up our query
        $sql = "INSERT INTO shelters (title, lat, lng, pName, pEmail, pPhone, pContactPub,
        type, oName, oEmail, oPhone, oContactPub, description, descriptionPub)
        VALUES ('$title', '$lat', '$lng', '$pName', '$pEmail', '$pPhone', '$pContactPub',
        '$type', '$oName', '$oEmail', '$oPhone', '$oContactPub', '$description', '$descriptionPub')";

        if ($link->query($sql) === true) {
           echo "New record created successfully";
           echo '<script>window.location = "'. '../auxPages/mapOfferShelterSuccess.html' .'";</script>';
        } else {
          $error = $link->error;
           return $error;
        }

      }
?>
