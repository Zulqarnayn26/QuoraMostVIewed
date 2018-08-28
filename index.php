<html>
<head>
<style> 
input[type=text] {
    width: 100%;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 15px;
    background-color: white;
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 10px;
}


.btn-group .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 9px 18px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    float: left;
}

.btn-group .button:hover {
    background-color: #3e8e41;
}
</style>
</head>
<body>

<form>
  
</form>

<form action="" method="post">
	<input type="text" name="name" placeholder="Put any Quora's question link. Ex: https://www.quora.com/How-does-it-feel-to-be-extremely-poor">
	<div class="btn-group">
		<button class="button">Submit</button>
	</div>
</form>

</body>
</html>

<?php
	include("getData.php");
	function space() {
    	echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
	}

	//print_r($_REQUEST);
	if(isset($_POST["name"])){
		$val = $_POST["name"];
		if(empty($val)) $val = "https://www.quora.com/How-does-it-feel-to-be-extremely-poor";
		$content = getData($val);
	}
	else {
		$content = getData("https://www.quora.com/How-does-it-feel-to-be-extremely-poor");	
	}
	
	$exploded_content = explode("<img class='profile_photo_img' src='", $content);
	$content_name1 = explode("</script><title>", $content);
	$content_name2 = explode(' - Quora</title><meta', $content_name1[1]);
	echo "<h1 style='color:#3498DB;'>\n\n\n\n\n\n\n\n\n".$content_name2[0] ."</h1>";

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

		//upvote
		
		echo "<br> <br>";

	}
	echo "<font size='5'>Find me in <a href='https://www.wordpresscom77092.wordpress.com' style='text-decoration:none'>  &nbsp Wordpress </a> <a href='https://github.com/Zulqarnayn26' style='text-decoration:none'> &nbsp&nbsp Github </a> <a href='https://www.linkedin.com/in/asif-mujtaba-084876147/' style='text-decoration:none'> &nbsp&nbsp linkedin</a></font>"; 
	
?>
