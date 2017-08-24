/*This function swaps the controller from the main controller to the
offer shelter form*/

function offerShelter() {
 document.getElementById("offerShelterForm").classList.toggle("hidden");
 document.getElementById("controller").classList.toggle("hidden");
 //if myPath is displayed, turn it off to give a clean map.
 if(pathDisplay == true){
   togglePath();
 }
}


//###############################################
//This script is for displaying hidden windows as a
//means to explain the offer shelter form


//privacyHidden
$(document).ready(function(){
  $("#getPrivacy").hover(function(){
    $("#privacyHidden").css('display', 'inline-block');

    },function(){
      $("#privacyHidden").css('display', 'none');
  })
})

//geoCoordinates
$(document).ready(function(){
  $("#getGeoCoordinates").hover(function(){
    $("#geoCoordinatesHidden").css('display', 'inline-block');

    },function(){
      $("#geoCoordinatesHidden").css('display', 'none');
  })
})

//add listener to return lat and lng coordinates on dbl click.
function getGeoCoordinates(){
  //add listener to respond to double click
    var listener1 = google.maps.event.addListener(mapCanvas, 'dblclick', function(event) {
        var myLatLng = event.latLng;
        //store lat and lng into variables
        var lat = myLatLng.lat();
        var lng = myLatLng.lng();
      //fill in data from the variable to the form
      document.getElementById('lat').value = lat;
      document.getElementById('lng').value = lng;
      //remove the instance of this listener
      listener1.remove();
    })
  }


//Get Owner Contact info if radio button is checked indicating the client is not the owner of this shelter
$(document).ready(function(){
  //the div containing radiobuttons is watched for checked
  $('#offerType input').on('change', function() {
    //if check radio belongs to group "notOwner" than div getOwner has class=hidden removed
    if(($('input[name=type]:checked', '#offerType').val() == "notOwner") || ($('input[name=type]:checked', '#offerType').val() == "organization")){
      $("#getOwner").removeClass("hidden");
    }
    //if otehr radio selected, class=hidden added
    else{
      $("#getOwner").addClass("hidden");
    }
  })
})
