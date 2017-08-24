<!DOCTYPE html>

<html>

  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">

    <title>Contact</title>
    <link rel="stylesheet" media="(min-width: 1301px)" href="ss/global_xlarge.css" />
    <link rel="stylesheet" media="(min-width: 1301px)" href="ss/contact/contact_xlarge.css" />
    <link rel="stylesheet" media="(min-width: 901px) and (max-width: 1300px)" href="ss/global_large.css" />
    <link rel="stylesheet" media="(min-width: 901px) and (max-width: 1300px)" href="ss/contact/contact_large.css" />
    <link rel="stylesheet" media="(min-width: 501px) and (max-width: 900px)" href="ss/global_medium.css" />
    <link rel="stylesheet" media="(min-width: 501px) and (max-width: 900px)" href="ss/contact/contact_medium.css" />
    <link rel="stylesheet" media="(max-width: 500px)" href="ss/global_small.css" />
    <link rel="stylesheet" media="(max-width: 500px)" href="ss/contact/contact_small.css" />

    <link href="https://fonts.googleapis.com/css?family=Economica|Nunito|Orbitron|Tangerine|Ubuntu" rel="stylesheet">


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
           <a href="whyiwalk.html">Why I Walk</a>
           <a href="howtohelp.html">How To Help</a>
         </div>
        </div>
        <a href="contact.html"><button class="nav">Contact</button></a>
        <!-- <a href="archive.html"><p id="navArchive">Archive</p></a> -->
        <img onclick="globeTrek()" id="navEarth" src="mats/earth/earth360nav.gif" alt="The Earth"/>
      </div>
    </nav>






    <h1 id="title">Talk With Us</h1>
    <section id="contentBox">

      <p>As the goal of our work is to unite people, foster tighter communities,
        and find universal tuths, we need to talk to one another.  Every individual
        holds a unique piece of the truth, and a personal expertise in their own
        perspective. </p><br>

      <div id="contactModes">
        <div id="contactModeTalk" class="contactMode">
          <h2>Lets Talk...</h2>
          <p class="contactModeP">about anything.  Ask a question, share a story,
            offer advice, say hello and lets converse.  After all, that is the
            point, of being part of humanity.
          </p>
          <button id="buttonTalk" onclick="contactLetsTalk()">Chin Wag</button>
        </div>
        <div id="contactModeOffer" class="contactMode">
          <h2>Offer Support...</h2>
          <p class="contactModeP">in any shape or form.  If you have connection,
            a roof, or a meal to offer along our projected path, please pin your
            location to the map and talk to us
          </p>
          <button id="buttonOffer" onclick="contactOfferHelp()">Give A Hand</button>
        </div>
        <div id="contactModeAsk" class="contactMode">
          <h2>Ask for Help...</h2>
          <p class="contactModeP">with a project or idea that you want to see
          manifest.  If you are on our projected path we would be happy to spend
          some time collaborating in trade shelter and friendship.
          </p>
          <button id="buttonAsk" onclick="contactAskHelp()">Lets Build</button>
        </div>
      </div>

      <div class="clear"></div>

      <!--<div id="contactCommunity">
        <h2>Share With The Community</h2>
        <p>Leave a note, pose a question, share a story.  Speak and be heard, by
          anyone who may venture this way after you.  We may be smart creatures,
          but we are surely are most genius when we think and converse in diverse
          groups.
        </p>
        <button id="buttonCommunity">Collaborate</button>
      </div>
    -->

    <p>We have our perspective, and you yours.  In sharing with one anoter, all
      participants learn, grow, expand their understandings of the world.  I certainly
      have allot to learn. As where many people have been my teachers, I still fall
      short of understanding the world and our place in it.   Please tell what you know,
      share what you like, and learn what you will.</p>

    <p>If you find yourself near us or on our projected
      path (<span class="globeTrekSpan" onclick="globeTrek()">the map</span>) dont
      hesitate to ask for help.  If you have a project your starting, I am curious
      to hear about it, brainstorm on it, work on some design and implementation if
      possible. It is my job as a human to help others follow their dreams and
      personal pursuits of happiness.  Or if you just need some firewood chopped...</p>
    <p>Else if you simply want to help us with our mission,
      there are plenty of ways to extend kindness.  We will certainly be weary travelers,
      and an unexpected kindness can make all the difference in the world.
       <br> <br> Best of Luck!  We are surely in this together.</p><br>


    </section>


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

    <script src="js/global.js">
      globeTrek();
    </script>
    <script src="js/contact.js"></script>


  </body>
</html>
