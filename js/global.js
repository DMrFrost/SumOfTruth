


//This function responds when user clicks terms and conditions in bottomBars
function termsConditions(){
  window.alert("There are no terms.  Use this content however you want.  I believe that freedom of information is in the best interest of humanity.")
}


 //<!-- API KEY: AIzaSyAZ95DBeM6bKfWe2masD19Q0SERwFJBuIY    AIzaSyBlrvqOygegHZee_K5Omrs-enyWEe3YeBc  -->
//function globeTrek(){
//  var myMap = document.getElementById("mapBox");
//  if(myMap.style.display === "none"){
//    myMap.style.display = "block";
//  }else{
//     myMap.style.display = "none";
//  }
  //will open my google maps in its own window.
  //mywindow = window.open("https://www.google.com/maps/embed/v1/place?key=AIzaSyAZ95DBeM6bKfWe2masD19Q0SERwFJBuIY&q=Portland+Oregon", "mywindow", "location=1,status=1,  width=500,height=500");
  //mywindow.moveTo(200, 150);
//}
//globeTrek();



function globeTrek(){
  var mapWindow = window.open("map/map.php", "Globe Trek", "width=900,height=700,left=100");
}

function contentGlobeTrek(){
  var mapWindow = window.open("../map/map.php", "Globe Trek", "width=900,height=700,left=100");
}
