$(document).ready(function(){
  $("#humanBody").hover(function(){
    $("#humanBody").css('width', '55%');
    $("#theTools").css('width', '35%');
    $("#humanCover").css('display', 'none');
    $("#humanUncovered").css('display', 'inline-block');
    $("#testDiv").css('display', 'inline-block');
  },function(){
    $("#humanBody").css('width', '45%');
    $("#theTools").css('width', '45%');
    $("#humanCover").css('display', 'inline-block');
    $("#humanUncovered").css('display', 'none');
    $("#testDiv").css('display', 'none');
  })
})
$(document).ready(function(){
  $("#theTools").hover(function(){
    $("#theTools").css('width', '55%');
    $("#humanBody").css('width', '34%');
    $("#theCase").css('display', 'none');
    $("#caseOpened").css('display', 'inline-block');

  },function(){
    $("#theTools").css('width', '45%');
    $("#humanBody").css('width', '45%');
    $("#theCase").css('display', 'inline-block');
    $("#caseOpened").css('display', 'none');

  })
})
