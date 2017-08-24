/*These scripts are designed to guide clients from the contact.php page to the correct
mail sending page.  These forms will then forward emails to the appropriate email address.*/

//this function directs user to "Lets Talk" email form
function contactLetsTalk(){
  var mapWindow = window.open("auxPages/contactLetsTalk.php", "Lets Talk", "width=700,height=600,left=100");
}

//this function directs user to "Offer Help" email form
function contactOfferHelp(){
  var mapWindow = window.open("auxPages/contactOfferHelp.php", "Offer Help", "width=700,height=600,left=100");
}

//this function directs user to "Ask for Help" email form
function contactAskHelp(){
  var mapWindow = window.open("auxPages/contactAskHelp.php", "Ask For Help", "width=700,height=600,left=100");
}
