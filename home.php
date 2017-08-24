<!DOCTYPE html>

<html>

  <head>
    <title>SumOne</title>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <link rel="stylesheet" media="(min-width: 1301px)" href="ss/home/home_xlarge.css"/>
    <link rel="stylesheet" media="(min-width: 1301px)" href="ss/global_xlarge.css"/>
    <link rel="stylesheet" media="(min-width: 901px) and (max-width: 1300px)" href="ss/home/home_large.css"/>
    <link rel="stylesheet" media="(min-width: 901px) and (max-width: 1300px)" href="ss/global_large.css"/>
    <link rel="stylesheet" media="(min-width: 501px) and (max-width: 900px)" href="ss/home/home_medium.css"/>
    <link rel="stylesheet" media="(min-width: 501px) and (max-width: 900px)" href="ss/global_medium.css"/>
    <link rel="stylesheet" media="(max-width: 500px)" href="ss/home/home_small.css"/>
    <link rel="stylesheet" media="(max-width: 500px)" href="ss/global_small.css"/>


    <link href="https://fonts.googleapis.com/css?family=Economica|Nunito|Orbitron|Tangerine|Ubuntu" rel="stylesheet">
    <script src="js/jquery-3.2.0.js"></script>


    <?php
    //NAV BAR ROTATION
      //set a variable to the path we want.  For large query we will go to large img folder
      $barImgRouletteContents ='./ss/home/imgBarRoulette';
      //set an array equal to all the contents of our folder, in this case all css files
      $fileStorage = scandir($barImgRouletteContents);
      //randomly select one index of the array, disregarding [0] and [1] ([.] and [..])
      $fileSelected = $fileStorage[mt_rand(2, 32)];
      //print a link too the randomly selected css file.
            echo "<link rel='stylesheet' href='ss/home/imgBarRoulette/" . $fileSelected . "'/>";
    ?>


  </head>

  <body>

      <!--Navigation Bar-->
    <nav id=navBar>
      <div>
        <a href="welcome.html"><p id="navWelcome">Welcome</p></a>
        <a href="home.php"><button class="nav">Home</button></a>
        <div class="dropTrigger" class="nav">
         <button class="nav" id="whoAmWe">Who Am We &#9662;</button>
         <div class="dropNav">
           <a href="philosophy.html">Philosophy</a>
           <a href="bio.html">Bio</a>
           <a href="howtohelp.html">How To Help</a>
         </div>
        </div>
        <a href="contact.php"><button class="nav">Contact</button></a>
        <!-- <a href="archive.html"><p id="navArchive">Archive</p></a> -->
        <img onclick="globeTrek()" id="navEarth" src="mats/earth/earth360nav.gif" alt="The Earth"/>
      <!--<img id="navEarth" src="mats/earth.png" alt="The Earth"/>-->
      </div>
    </nav>

    <h1 id="homeTitle">Home Is The Journey</h1>
    <div id="homeContentBox">
      <section class="homeDiv">

        <?php
        //DIV CONSTRUCTOR

          class divObject{
            public $title = 'SumWork';
            public $author = 'SumOne';
            public $date = 'SumDate';
            //sample img
            public $thumbNail = 'SumThumbnail';
            //the address to the content
            public $link = 'SumLink';

            //to store the first 100 characters of content to diplay as a sample of the work
            public $contentSample = array('SumContent');

            //to pass in the variables and array to this method.  These inputs will be assigned to our div Object
            public function __construct($TITLE, $AUTHOR, $DATE, $LINK, $CONTENTsAMPLE){
              $this->title = $TITLE;
              $this->author = $AUTHOR;
              $this->date = $DATE;
              //$this->thumbnail = $THUMBnAIL;
              $this->link = $LINK;
              $this->contentSample = $CONTENTsAMPLE;
            }
          };

          //establish the directory we will access
          $contentTxtDirectory ='./content/contentTxt';
          //set an array equal to all the contents of our contentTxt, all txt files associated with content
          //strrev to reverse the array, allowing to access new content first
          $contentArray = array_reverse(scandir($contentTxtDirectory));
          //establish a variable to determine where content ends.  Avoid last two positions in the array (.) and (..)
          $contentLength = (count($contentArray) - 2);

          //establish the directory with our content.php files to direct our links
          $contentPhpDirectory = './content';
          //set array equal to the contents of our content folder, reverse the arrayDump
          $contentPhpArray = array_reverse(scandir($contentPhpDirectory));

          //loop, in which our content texts can be accessed and dumped into their divs
          for($i = 0; $i < $contentLength && $i < 20; $i++){
            //Assign the lines of text as indices in an array to access
            $arrayDump = file("./content/contentTxt/$contentArray[$i]");
            $TITLE = $arrayDump[0];
            $AUTHOR = $arrayDump[1];
            $DATE = $arrayDump[2];
            //$THUMBnAIL = $arrayDump[#];
            //dump all our php file and reverse them.  Then add 5 to skip the 5 folders
            //in array positions [0]-[4]
            $phpDump = $contentPhpArray[$i+5];
            //this will be the link our div directs us to on click
            $LINK = "content/" . $phpDump;

            print($contentPhpArray);


            //if arrayDump[3] < 180 chars, combine [3]+[4],
            //store 180 chars prefixed to ... in $CONTENTsAMPLE
            $CONTENTsAMPLE = substr($arrayDump[3], 0, 200) . "...";

            //ONE MASTER DIV TO RULE THEM ALL
            echo  "<section>";
            echo   "<a href=" . $LINK . ">";
            echo    "<div class='contentDiv'>";
            echo      "<h2><span id='contentTitle' class='contentTitle'>" . $TITLE . "</span></h2>";
            echo      "<p><span class='contentCont'>" . $CONTENTsAMPLE . "</span></p>";
            echo      "<img class='contentImg' src='mats/philos.png' alt='Writing'/>";
            echo    "</div>";
            echo    "<div class='bottomTabs'>";
            echo      "<div class='contentAuthor'>";
            echo        "<h3>$AUTHOR</h3>";
            echo      "</div>";
            echo      "<div class='contentDate'>";
            echo        "<h3>$DATE</h3>";
            echo      "</div>";
            echo    "</div>";
            echo   "</a>";
            echo  "</section>";
          }
        ?>
      </section>
    </div>



    <footer id=endbar>
      <div id="cc_logo">
        <img id="cc_img" src="mats/cc.png" alt="(cc)"/>
      </div>
      <div id="cc_clause">
        <h6>All content on this site is shared, and may be used under Creative
        Commons for any project, anywhere.  Please create responsibly and
        intelligibly.  Please voice your oppionion, and acknowledge that you
        may be wrong.<br> <a href="#" id="termsconditions" onclick="termsConditions()">terms conditions</a></h6>
      </div>
    </footer>





    <script src="./js/global.js"></script>
    <script src="./js/cookies.js"></script>

    <script>
    //on first visit display map indicator and explanation
      var firstVisit = getCookie("intro_cookie");
      if(!firstVisit){
        setCookie("intro_cookie", true, 365);
        document.write("<div id='introDiv'><p>Click this globe to see where I am.</p></div>");
      }
    </script>
  </body>
</html>
