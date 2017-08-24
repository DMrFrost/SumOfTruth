/*This script allows the dynamic interaction of controller divs.
The mapSelOptions resize when hovered over */

$(document).ready(function(){
  $("#pathPlanet").hover(function(){
    $("#myPath").toggleClass("divBig");
    $("#offerShelter").toggleClass("divSmall");
    $("#showShelter").toggleClass("divSmall");
    $("#controller").css('height', '90px');
    },function(){
      $("#myPath").toggleClass("divBig");
      $("#offerShelter").toggleClass("divSmall");
      $("#showShelter").toggleClass("divSmall");
      $("#controller").css('height', '120px');

  })
})

$(document).ready(function(){
  $("#earthDoor").hover(function(){
    $("#offerShelter").toggleClass("divBig");
    $("#myPath").toggleClass("divSmall");
    $("#showShelter").toggleClass("divSmall");
    $("#controller").css('height', '90px');
    },function(){
      $("#offerShelter").toggleClass("divBig");
      $("#myPath").toggleClass("divSmall");
      $("#showShelter").toggleClass("divSmall");
      $("#controller").css('height', '120px');
  })
})

$(document).ready(function(){
  $("#shelterCircle").hover(function(){
    $("#showShelter").toggleClass("divBig");
    $("#offerShelter").toggleClass("divSmall");
    $("#myPath").toggleClass("divSmall");
    $("#controller").css('height', '90px');
    },function(){
      $("#showShelter").toggleClass("divBig");
      $("#offerShelter").toggleClass("divSmall");
      $("#myPath").toggleClass("divSmall");
      $("#controller").css('height', '120px');
  })
})
