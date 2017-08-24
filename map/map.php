<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="map.css"/>
    <title>Map</title>
  </head>


  <body>

    <!--MAP CANVAS-->
    <div id="mapCanvas"></div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlrvqOygegHZee_K5Omrs-enyWEe3YeBc" type="text/javascript">
    </script>

    <script>
//############################################################################
//MAP CONTROLLER MAP CONTROLLER MAP CONTROLLER MAP CONTROLLER MAP CONTROLLER
//############################################################################

      //building my map object with all of its options
      var mapOptions = {
        center: {lat:45.4925378, lng:-119.5987815},
        zoom: 6,
        zoomControl: true,
        panControl: false,
        mapTypeControl: true,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
          position: google.maps.ControlPosition.TOP_RIGHT
        },
        scaleControl: true,
        streetViewControl: false,
        overviewMapControl: false,
        mapTypeId: google.maps.MapTypeId.TERRAIN,
      };
      //creating map object and passing it out options
      var mapCanvas = new google.maps.Map(document.getElementById('mapCanvas'), mapOptions);

      //################################################################
      //RETRIEVE MARKER DATA RETRIEVE MARKER DATA RETRIEVE MARKER DATA
      //Import JSON data into a variable.
      var markersXMLhttp = new XMLHttpRequest();
      //open the request and store parameters for the request.  GET (or POST) is method to send,
      //the pathway or url of the data is specified, and whether or not the request is asynchronous
      markersXMLhttp.open("GET", "json/myMapMarker.json", false);
      //send the request
      markersXMLhttp.send();
      //there conditions allow the request to wait until the server respondes that it is ready.
      if(markersXMLhttp.readyState == 4 && markersXMLhttp.status == 200){
        //the response is stored in a variable
        var XMLmarkersResult = markersXMLhttp.responseText;
      }
      //convert JSON string to javascript object
      var markersResult = JSON.parse(XMLmarkersResult);

      //######################################################################
      //SET MARKERS SET MARKERS SET MARKERS SET MARKERS SET MARKERS SET MARKERS
      //######################################################################
            //This function will set all my markers
            function setMarkers(){
              for(i=0; i < markersResult.myMarkers.length; i++){
                var markerOptions = {
                  position : markersResult.myMarkers[i].position,
                  map : mapCanvas,
                  description : markersResult.myMarkers[i].description,
                };

              //create marker
              this ['marker' + i] = new google.maps.Marker(markerOptions);
              }
            }setMarkers();

            //This function will hide all of my path markers set to mapCanvas
            function hideMarkers(){
              for(i=0; i < markersResult.myMarkers.length; i++){
                //hide marker
                var marker = this ['marker' + i];
                marker.setMap(null);
              }
            }

//PATH COORDS PATH COORDS PATH COORDS PATH COORDS PATH COORDS PATH COORDS
      //crate array to store path coordinates for polyLine
      var pathCoordinates = []

      //pass all my lat lng data from JSON to an array
      for(i = 0; i <  markersResult.myMarkers.length; i++){
        pathCoordinates[i] = new google.maps.LatLng(markersResult.myMarkers[i].position);
      }


//#############################################################################
//POLY LINE CONTROL POLY LINE CONTROL POLY LINE CONTROL POLY LINE CONTROL POLY LINE CONTROL
//#############################################################################
      //create a new polyline Object from google
      var polyLineWalked = new google.maps.Polyline({
        path: pathCoordinates,
        strokeColor: "rgb(100, 100, 200)",
        strokeOpacity: 1.0,
        strokeWeight: 3
      });


      //function to display ployline
      function showPolyLine(){
        polyLineWalked.setMap(mapCanvas);
      }showPolyLine();
      //function to hide polyline
      function hidePolyLine(){
        polyLineWalked.setMap(null);
      }


//############################################################################
//PROJECTED PATH CONTROLLER PROJECTED PATH CONTROLLER PROJECTED PATH CONTROLLER
//############################################################################
      //set up a variable to control rotatoion of projected path in degrees
      var rotationInDegrees = -82;
      var scopeLength = 10;
      var scopeWidth = 6;
      //setting the value of the initiating point of my projected path, to the lat and lng of the last item of markersResult.myMarkers Obj
      var myLat = markersResult.myMarkers[markersResult.myMarkers.length -1].position.lat;
      var myLng = markersResult.myMarkers[markersResult.myMarkers.length -1].position.lng;

      //function to convert degrees to radians
      //Radians = Degrees * (PI/180)
      function rotationInRadians(){
        var rotationInRadians = rotationInDegrees*(Math.PI/180);
        return rotationInRadians;
      }

      //call function to find value for rotation in Radians
      var rotationInRadians = rotationInRadians(rotationInDegrees)

      //setting the coordinates for the outer blue triangle us the trig equaton to rotate the point around the center of a circle.
      //where 0 = the angle of rotation in radians
      //position X = xcos0-ysin0
      //position Y = ycos0 + xsin0
      var triangleCoordsOut = [
          //origin of triangle
          {lat: myLat, lng: myLng},
          //Bottom point of triangle it -90 degrees
          {lat: myLat - ((scopeLength*(Math.cos(rotationInRadians)))+(-(scopeWidth/2)*(Math.sin(rotationInRadians)))),
              lng: (myLng + ((-(scopeWidth/2)*(Math.cos(rotationInRadians)))-(scopeLength*(Math.sin(rotationInRadians)))))},
          //Top point of triangle heading at -90 degrees
          {lat: myLat - ((scopeLength*(Math.cos(rotationInRadians)))+((scopeWidth/2)*(Math.sin(rotationInRadians)))),
              lng: (myLng + (((scopeWidth/2)*(Math.cos(rotationInRadians)))-(scopeLength*(Math.sin(rotationInRadians)))))},
      ];

      //setting the coordinates of the middle green triangle
      var triangleCoordsMid = [
          {lat: myLat, lng: myLng},
          {lat: myLat - ((scopeLength*(Math.cos(rotationInRadians)))+(-(scopeWidth/4)*(Math.sin(rotationInRadians)))),
              lng: (myLng + ((-(scopeWidth/4)*(Math.cos(rotationInRadians)))-(scopeLength*(Math.sin(rotationInRadians)))))},
          //Top point of triangle heading at -90 degrees
          {lat: myLat - ((scopeLength*(Math.cos(rotationInRadians)))+((scopeWidth/4)*(Math.sin(rotationInRadians)))),
              lng: (myLng + (((scopeWidth/4)*(Math.cos(rotationInRadians)))-(scopeLength*(Math.sin(rotationInRadians)))))},
      ];

      // Construct the outer polygon object.
      var outerTriangle = new google.maps.Polygon({
        paths: triangleCoordsOut,
        strokeColor: 'black',
        strokeOpacity: 0.5,
        strokeWeight: 1,
        fillColor: 'rgb(0, 0, 250)',
        fillOpacity: 0.15
      });

      //placing the object on my mapCanvas
      function showOuterTriangle(){
      outerTriangle.setMap(mapCanvas);
      }showOuterTriangle();
      //hide outerTriangle from the mapCanvas
      function hideOuterTriangle(){
      outerTriangle.setMap(null);
      }showOuterTriangle();

    // Construct the middle polygon object.
    var middleTriangle = new google.maps.Polygon({
      paths: triangleCoordsMid,
      strokeColor: 'black',
      strokeOpacity: 0.2,
      strokeWeight: 1,
      fillColor: 'rgb(0, 250, 0)',
      fillOpacity: 0.15
    });

  //show middleTriangle object on my mapCanvas
    function showMiddleTriangle(){
      middleTriangle.setMap(mapCanvas);
    } showMiddleTriangle();
    //hide middleTriangle object on my mapCanvas
    function hideMiddleTriangle(){
      middleTriangle.setMap(null);
    }showMiddleTriangle();

//############################################################################
//TOGGLE PATH TOGGLE PATH TOGGLE PATH TOGGLE PATH TOGGLE PATH TOGGLE PATH
//############################################################################
          //establish variable to track if myPath is displayed or hidden
          var pathDisplay = true;

          //a function to show and hide; markers, path, and projection through console interaction
          function togglePath(){
            if(pathDisplay == true){
              hideMarkers();
              hidePolyLine();
              hideOuterTriangle();
              hideMiddleTriangle();
              document.getElementById('myPathTxt').innerHTML = "Show Path";
              pathDisplay = false;
            }else{
              setMarkers();
              showPolyLine();
              showOuterTriangle();
              showMiddleTriangle();
              document.getElementById('myPathTxt').innerHTML = "Hide Path";
              pathDisplay = true;
            }
          }
    </script>


    <script>
    //######################################################
    //RETRIEVE AND DISPLAY SHELTER DATA
    //######################################################
    //set array to contain my retrieved data.
      var arrayOfShelters = [];

    //RETRIEVE MARKER DATA RETRIEVE MARKER DATA RETRIEVE MARKER DATA
    //Import JSON data into a variable.
      function getShelterData(){
        var dataXMLhttp = new XMLHttpRequest();
      //open the request and store parameters for the request.  GET (or POST) is method to send,
      //the pathway or url of the data is specified, and whether or not the request is asynchronous
        dataXMLhttp.open("GET", "./sqlFunctions/returnData.php", true);
      //send the request
        dataXMLhttp.send();
        dataXMLhttp.onreadystatechange=function(){
      //there conditions allow the request to wait until the server respondes that it is ready.
          if(dataXMLhttp.readyState == 4 && dataXMLhttp.status == 200){
        //the response is stored in a variable
            XMLdataResult = dataXMLhttp.responseText;
            //window ties the variable to the global window object
            arrayOfShelters = eval(XMLdataResult);
            setShelterMarkers();
          }
        }
      }


    //the function to pass retrieved data -> shelter objects -> google maps api.
      function setShelterMarkers(){
        //create string to hold html div
        var shelterDivString = [];

        //run a loop to place each object of the array into an object
        for(i=0; i < arrayOfShelters.length; i++){
        let contactPublic =  arrayOfShelters[i].pContactPub == true ? "<br><strong>Contact:</strong>" : "";
        //this will be the div of an individual shelter
        let shelterDivStringPart = "<div class='shelterSideBarDiv' id='shelterSideBarDiv" + i + "'><h3>" + arrayOfShelters[i].title + "</h3><p>" + arrayOfShelters[i].description + "</p><p>" + contactPublic + arrayOfShelters[i].pName +  "</p></div><hr>"
        shelterDivString.push(shelterDivStringPart);
        //create "position" google.maps object
          var myLatLng = new google.maps.LatLng(arrayOfShelters[i].lat, arrayOfShelters[i].lng);
          var shelterOptions = {
            position : myLatLng,
            map : mapCanvas,
            description : arrayOfShelters[i].title,
            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
          };
        //create marker with unique identifier i to allow deleting all shelterMarkers
          this ['shelter' + i] = new google.maps.Marker(shelterOptions);
          attachInfoWindow(this ['shelter' + i], shelterOptions);
        }
        document.getElementById("shelterData").innerHTML = shelterDivString;
      }


    //attach an infowindow to each shelter.marker objects and add a click listener
      function attachInfoWindow(marker, data) {
        var infowindow = new google.maps.InfoWindow({
          content: "<h2>Where is a title</h2><p>" + data.description + "</p>"
        });
        marker.addListener('click', function() {
          infowindow.open(marker.get('mapCanvas'), marker);
          document.getElementById("shelterSideBarDiv2").classList.toggle("activeShelterDiv");
          document.getElementById("shelterDataSideBar").scrollTop += (20 + (50*3));
        });
      }




    //variable to initialize shelter data retrieval
      var initShelters = false;
    //Function handles data array, rerievs it if necessary, or skips data retrievel
      function setShelters(){
        if(initShelters == false){
          getShelterData();
          initShelters = true;
        }else {
          setShelterMarkers();
        }
      }


    //This function will hide all of my path markers set to mapCanvas
      function hideShelters(){
        for(i=0; i < arrayOfShelters.length; i++){
          //hide marker
          var shelter = this ['shelter' + i];
          shelter.setMap(null);
        }
      }

    //variable to track if shelters are off or on
      var sheltersDisplayed = false;

    //function to handle the toggle event when shelter div is clicked
      function toggleShelters(){
        //toggle info box shelterData
        document.getElementById("shelterDataSideBar").classList.toggle("hidden");
        if(sheltersDisplayed == false){
          setShelters();
          document.getElementById('myShelterTxt').innerHTML = "Hide Shelter";
          sheltersDisplayed = true;
        }else{
          hideShelters();
          document.getElementById('myShelterTxt').innerHTML = "Show Shelter";
          sheltersDisplayed = false;
        }
      }

    </script>




    <!--####################################################################
    Following is the controller window, diveded into 3 divs each div offering a
    action.  Actions are: togglePath() offerHelp() and toggleRefuge()
    #############################################################################-->
    <section id="controller">

      <div class="mapSelOption" id="myPath">
        <img onclick="togglePath()" class="mapSelImg" id="pathPlanet" src="mats/pathPlanet150.png" alt="Path World"/>
        <h3 class="mapSelTxt" id="myPathTxt">Hide Path</h3>
      </div>
      <div class="mapSelOption" id="offerShelter">
        <img class="mapSelImg" id="earthDoor" src="mats/earthDoor150.png" alt="Door World"  onclick="offerShelter()"/>
        <h3 class="mapSelTxt">Offer Shelter</h3>
      </div>
      <div class="mapSelOption" id="showShelter">
        <img class="mapSelImg" id="shelterCircle" src="mats/sheltersCircle150.png" alt="Shelter Circle"   onclick="toggleShelters()"/>
        <h3 class="mapSelTxt" id="myShelterTxt">Show Shelter</h3>
      </div>
    </section>


    <!--###################################################################
    A Div to Display Shelter Data
    #####################################################################-->
      <section id="shelterDataSideBar" class="hidden">
        <div>
          <div class="dragBar"></div>
          <h2>Shelters On The Map</h2>
          <hr>
          <div  id="shelterData">

          </div>
        </div>
      </section>



      <!--###################################################################
      Here we creat a div to input client data and to store shelters offered
      #####################################################################-->
        <section id="offerShelterForm" class="hidden">

          <!--A Button to exit the form-->
          <div id="getReturn">
            <!--<button id="offerSFReturn" onclick="offerShelter()">Back To Map</button>-->
            <button id="offerSFReturn" onclick="offerShelter()" >Back</button>
          </div>

          <div id="formExplained" class="hiddenTxt">
            <h1>Offer A Roof</h1>
            <p>
                  Thank you for opening a door.  If you have a spare bed,
                  a roof, or even a comfy patch of dirt and would like to share shelter,
                  company and conversation; please fill out the form below.  If you are
                  putting down a marker for a place which is not your own, be sure you
                  have consent from the individual or family who reside there.  If you are
                  recomending or speaking for an organization or institue, please indicate
                  this, and provide contact details.
            </p>
          </div>

          <div id="getPrivacy">
            <h4>Privacy Info</h4>
          </div>

          <form  method="post" id="shelterForm">
            <div class="sF">
              <h5>A title for this spot:</h5>
              <input type="text" name="title"  id="nameOfShelter" size="20px" maxlength="50" placeholder="Name of Location" required value="<?php echo $_POST['title'] ?>">
            </div>

            <div class="sF" id="geoCoordinates">
              <h5>Select latitude and longitude.</h5>
              <div id="getGeoCoordinates" onclick="getGeoCoordinates()">
                <h4>Get Coordinates</h4>
              </div>

              <input type="number" step="any" name="lat" id="lat" size="5px" maxlength="15" placeholder="latitude" required value="<?php echo $_POST['lat'] ?>"><br>
              <input type="number" step="any" name="lng" id="lng" size="5px" maxlength="15" placeholder="longitude" required value="<?php echo $_POST['lng'] ?>">
            </div>

            <div class="sF" id="yourContactDetails">
              <h5>Your Contact Details</h5>
              <input type="text" name="pName" id="yourContactName" size="20px" maxlength="40" placeholder="Your Name" value="<?php echo $_POST['pName'] ?>">
              <br>
              <input type="email" name="pEmail" id="yourContactEmail" size="20px" maxlength="40" placeholder="Your Email" value="<?php echo $_POST['pEmail'] ?>">
              <h5>And/Or</h5>
              <input type="text" name="pPhone" id="yourContactPhone" size="10px" maxlength="20" placeholder="Your Phone#" value="<?php echo $_POST['pPhone'] ?>">
              <div class="makePublic">
                <div class="radioPrivacy">
                  <label>private<input type="radio" name="pContactPub" value="0" <?php if($_POST['pContactPub'] == 0){echo 'checked="checked"';}?>></label>
                </div>
                <div class="radioPrivacy">
                  <label>public<input type="radio" name="pContactPub" value="1" <?php if($_POST['pContactPub'] == 1){echo 'checked="checked"';}?>></label>
                </div>
              </div>
            </div>

            <div class="sF" id="offerType">
              <h5>How would you describe this location?</h5>
              <label>my residence<input type="radio" name="type" value="isOwner" required <?php if($_POST['type'] == "isOwner"){echo 'checked="checked"';}?>></label><br>
              <label>others residence<input type="radio" name="type" class="notOwner" value="notOwner" <?php if($_POST['type'] == "notOwner"){echo 'checked="checked"';}?>></label><br>
              <label>organization<input type="radio" name="type" class="notOwner" value="organization" <?php if($_POST['type'] == "organization"){echo 'checked="checked"';}?>></label>

              <div id="getOwner" class="hidden" >
                <h5>Please provide a contact for this location.</h5>
                <input type="text" name="oName" id="itsContactName" size="20px" maxlength="40" placeholder="Contacts Name" value="<?php echo $_POST['oName'] ?>">
                <input type="email" name="oEmail" id="itsContactEmail" class="notOwner" size="20px" maxlength="40" placeholder="Contacts Email" value="<?php echo $_POST['oEmail'] ?>">
                <input type="text" name="oPhone" id="itsContactPhone" class="notOwner" size="10px" maxlength="40" placeholder="Contacts Phone" value="<?php echo $_POST['oPhone'] ?>">
                <div class="makePublic">
                  <div class="radioPrivacy">
                    <label>private<input type="radio" name="oContactPub" value="0" <?php if($_POST['oConntactPub'] == 0){echo 'checked="checked"';}?>></label>
                  </div>
                  <div class="radioPrivacy">
                    <label>public<input type="radio" name="oContactPub" value="1" <?php if($_POST['oContactPub'] == 1){echo 'checked="checked"';}?>></label>
                  </div>
                </div>
              </div>
            </div>

            <div class="sF" id="shelterContactDetails"></div>

            <div class="sF" id="shelterdescription">
              <h5>Any other information or details to know about?</h5>
              <textarea type="text" name="description" id="description" rows="5" cols="30" maxlength="600" placeholder="Description"><?php echo $_POST['description'] ?></textarea>
              <div class="makePublic">

                <div class="radioPrivacy">
                  <label>private<input type="radio" name="descriptionPub" value="0" <?php if($_POST['descriptionPub'] == 0){echo 'checked="checked"';}?>></label>
                </div>
                <div class="radioPrivacy">
                  <label>public<input type="radio" name="descriptionPub" value="1" <?php if($_POST['descriptionPub'] == 1){echo 'checked="checked"';}?>></label>
                </div>


              </div>
            </div>

              <br>
              <input type="submit" name="submit" value="Submit" id="submitSF">
            </form>
        </section>


    <!--Hidden Text Boxes-->
        <div id="privacyHidden" class="hidden">
          <p class="hiddenTxt">
            Your right to privacy is important.  The "Title" and the location
            marker will be displayed to the public.<br><br>
            By default all other information is set to private.  However you have
            the option to make any data you wish public.  Please make sure to check
            the public option next to any data you would like to share with the public.
          </p>
        </div>

        <div id="geoCoordinatesHidden" class="hidden">
          <p class="hiddenTxt">
            Click "Get Coordinates", and then double click on the map where you wish to place your marker.
            This will automatically fill in your geocoordinates.
          </p>
        </div>




        <script src="./js/offerShelter.js" type="text/javascript">//script to open and close offerShelterForm</script>
        <script src="./js/controllerSize.js" type="text/javascript">//script to work with privacyHidden</script>
        <!-- <script src="./js/showShelter.js" type="text/javascript">//script for toggling on and off visible shelter icons.</script> -->

        <script type="text/javascript">
          //retrieve session variable established on form submission to see if page is being reloaded from submission form
          //if so then we will open the offerShelterForm again to allow user to easiely complete it.
          var reload = sessionStorage.getItem('pageReload');
          if(reload){
            //open OfferShelterForm
            offerShelter();
            //open Owner Contact if associated radio button is checked
            if(($('input[name=type]:checked', '#offerType').val() == "notOwner") || ($('input[name=type]:checked', '#offerType').val() == "organization")){
              $("#getOwner").removeClass("hidden");
            }
            //if My Residence radio selected, class=hidden added
            else{
              $("#getOwner").addClass("hidden");
            }
          }
        </script>

        <script type="text/javascript">
          //set variable in session storage if when page is submitted.
          $('input[type="submit"][value="Submit"]').click(function() {
            sessionStorage.setItem('pageReload', 'true');
          })
        </script>



        <?php
      //#############################################################
      //MYSQL DATABASE MYSQL DATABASE MYSQL DATABASE MYSQL DATABASE
      //#############################################################

          include('./sqlFunctions/sqlFunctions.php');
        //link to mySQL database
          $link = linkDB();

        //On Submit execute the following code
          if($_POST['submit']){
          //pass link to submission function.  If errors encounted script will die and
          //pass the errors back.
            $error = submitDB($link);

            if($error){
          //pass errors from php to session Storage to display on reload
              echo "<script type='text/javascript'>sessionStorage.setItem('error', '$error');</script>";
            //Here is a script to pass the sessionStorage error variable to javascript variable
              echo "<script>";
              echo   "var error = sessionStorage.getItem('error');";
            //if any errors stored in sessionStorage, place them in main div
              echo  "if(error){";
            //write the error message into the main div in offerShelterForm
              echo    "document.getElementById('formExplained').innerHTML = \"<div class='error'><p>\" + error + \"</p></div>\";";
              echo  "}";
              echo "</script>";
            //kill the rest of the php code
              die();
            }
          }
        ?>

  </body>
</html>
