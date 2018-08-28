<?php
	include("getData.php");
	function space() {
    	echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
	}

	$content = getData("https://www.quora.com/Is-the-never-give-up-attitude-always-helpful");
	$exploded_content = explode("<img class='profile_photo_img' src='", $content);
	
	$content_name1 = explode("</script><title>", $content);
	$content_name2 = explode(' - Quora</title><meta', $content_name1[1]);
	echo "<h1 style='color:#3498DB;'>".$content_name2[0] ."</h1>";

	for ($x = 1; $x < sizeof($exploded_content); $x++) {
		//image
		$img  = explode("'", $exploded_content[$x]);
		echo "<img src='" .$img[0] . "' />";

		//name
		$name1 = explode("' height='", $exploded_content[$x]);
		$name2 = explode("' alt='", $name1[0]);
		echo "&nbsp&nbsp";
		echo "<b>   Name : </b>";
		print_r($name2[1]);
		
		//views
		$view1 = explode("class='meta_num'>", $exploded_content[$x]);
		$view2 = explode("</span>", $view1[1]);
		space();
		echo " <b> Views : </b>";
		print_r($view2[0]);

		// READ answer
		$ref1 = explode("<a class='answer_permalink' action_mousedown='AnswerPermalinkClickthrough' href='", $exploded_content[$x]);
		$ref2 = explode("' id='", $ref1[1]);
		space();
		echo "<a href='https://www.quora.com".$ref2[0]."' style='text-decoration:none'><b>Read Answer</b></a>";

		//user ID
		space();
		$userId1 = explode("<a class='user' href='/profile/", $exploded_content[$x]);
		if(!isset($userId1[1])) echo "<b>Profile : </b>".$name2[1];
		else {
			$userId2 = explode("' action_mousedown='UserLinkClickthrough' id='", $userId1[1]);
			echo "<b>Profile : </b><a class='user' href='https://www.quora.com/profile/".$userId2[0]."'style='text-decoration:none'>$name2[1]</a>";
		}
		
		echo "<br> <br>";
	}
?>
