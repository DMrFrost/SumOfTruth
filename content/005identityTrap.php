<!DOCTYPE html>
<html>
	<head>
		<title>SumOne</title>
		<link rel="stylesheet" media="(min-width: 1301px)" href="contentCss/content_global_xlarge.css" />
    <link rel="stylesheet" media="(min-width: 901px) and (max-width: 1300px)" href="contentCss/content_global_large.css" />
    <link rel="stylesheet" media="(min-width: 501px) and (max-width: 900px)" href="contentCss/content_global_medium.css" />
    <link rel="stylesheet" media="(max-width: 500px)" href="contentCss/content_global_small.css" />


    <link href="https://fonts.googleapis.com/css?family=Orbitron|Tangerine|Ubuntu" rel="stylesheet">
    <meta charset="utf-8">

	</head>
	<body>

		<?php
				//######################################################################
				//TARGET CONTROLLER TARGET CONTROLLER TARGET CONTROLLER TARGET CONTROLLER
				//######################################################################
				//file() pulls out all everyline in target file and stores each line as an index in my array $myContent
				$myContent = file("contentTxt/005identityTrap.txt");
		 ?>

    <nav id=navBar>
      <div>
        <a href="../welcome.html"><p id="navWelcome">Welcome</p></a>
        <a href="../home.php"><button class="nav">Home</button></a>
        <div class="dropTrigger" class="nav">
         <button class="nav" id="whoAmWe">Who Am We &#9662;</button>
         <div class="dropNav">
           <a href="../philosophy.html">Philosophy</a>
           <a href="../bio.html">Bio</a>
           <a href="../howtohelp.html">How To Help</a>
         </div>
        </div>
        <a href="../contact.php"><button class="nav">Contact</button></a>
        <!-- <a href="../archive.html"><p id="navArchive">Archive</p></a> -->
        <img onclick="contentGlobeTrek()" id="navEarth" src="contentMats/earth360nav.gif" alt="The Earth"/>
      </div>
    </nav>




		<!-- a div to contain all content elements-->
		<section id="contentBox">

			<?php
				//print out my title from $myContent index [0]
				print ("<h1 id='title'>" . $myContent[0] . "</h1>");
				//variable to track how many paragraphs there are to make references addition quicker
				//start at 3 to skip [0] [1] [2]
				$contentTracker = 3;
				//a variable to be used in our loop, this variable will alternate whether an image is assigned to
				//class .imgRight or .imgLeft
				$imgTracker = true;
				//this for loop prints all indices of the array $myContent after [0],[1], and [2], as paragraphs to my content
				for($i = 3; $i < count($myContent); $i++){
					//a variable to check the first 5 chars of string for content markers
					$contentProbe = substr($myContent[$i], 0, 5);
						//check to see if array index is an <img>
						if($contentProbe == "<img>"){
							//we save the rest of the string as a variable
							$imgLink = substr($myContent[$i], 5);
							if($imgTracker == true){
								$imgTracker = false;
								//we print the img tag with embedded image link assigning it to float right
								print "<img class='imgRight' src='$imgLink' width='400px' alt='My Image Obviously Didnt Load'><br>";
							}else{
								$imgTracker = true;
								//we print the img tag with embedded image link assigning it to float left
								print "<img class='imgLeft' src='$imgLink' width='400px' alt='My Image Obviously Didnt Load'><br>";
							}

						}elseif($contentProbe == "<ref>"){
							break;
						}else{
							//print non <img> and non <ref> content
							print "<p>" . $myContent[$i] . "</p><br>";
						}
					//contentTracker has one added each iteration to mark where the references start
					$contentTracker++;
				}
			?>


			<br><br>
			<!--here the author and date are filled in from my txt file useind the [1] and [2] array indices-->
			<h3><span id="Author"><?php print $myContent[1]; ?></span>: <span id="Date"><?php print $myContent[2]; ?></span></h3><br><br>
			<!--start of references-->
			<h4 id="ref">References:<br></h4>

			<?php
				//set $i equal to my content tracker which counted the number of paragraphs in my content
				for($i = $contentTracker; $i < count($myContent); $i++){
					//a variable to check the first 5 chars of string for content markers
					$contentProbe = substr($myContent[$i], 0, 5);
						//check to see if array index is a <ref>
						if($contentProbe == "<ref>"){
							//capture the rest of array in a variable
							$refLink = substr($myContent[$i], 5);
							//echo the variable into h4 div
							echo "<h5>$refLink</h5><br>";
						}
					}
			 ?>




		</section>




		<footer id=endbar>
			<div id="cc_logo">
				<img id="cc_img" src="contentMats/cc.png" alt="(cc)"/>
			</div>
			<div id="cc_clause">
				<h6>All content on this site is shared, and may be used under Creative
				Commons for any project, anywhere.  Please create responsibly and
				intelligibly.  Please voice your oppionion, and acknowledge that you
				may be wrong.<br><a href="#" id="termsconditions" onclick="termsConditions()">terms conditions</a></h6>
			</div>
		</footer>



		<script src="../js/global.js">
		</script>

	</body>
</html>
