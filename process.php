<?php
	include 'init.php';
	include 'functions.php';


	$urlarray = json_decode($_POST['array'],true); 

	$urlres = array();
	
	for($i = 0; $i < sizeof($urlarray) ; $i++){
		if(urlvalidator($urlarray[$i]))
		{
			$myobj = new stdClass();
			if(urlHasBeenShortened($urlarray[$i])){
				$short = 'sheltered-reef-71316.herokuapp.com?id='.getURLID($urlarray[$i]);
				$dates = getDates(getURLID($urlarray[$i]));
				$clicks = getClicks(getURLID($urlarray[$i]));
				$myobj->Original = $urlarray[$i];
				$myobj->Short = $short;
				$myobj->dates = $dates;
				$myobj->clicks = $clicks;
			array_push($urlres,$myobj);
			
				continue;
			}
			
			$id = rand(10000,99999);

			if(idExists($id) == true){
				$id = rand(10000,99999);
			}
			
			insertID($id, $urlarray[$i]);
			
			
			$dates = getDates(getURLID($urlarray[$i]));
			$short = 'sheltered-reef-71316.herokuapp.com?id='.$id;
			$myobj->Original = $urlarray[$i];
			$myobj->Short = $short;
			$myobj->dates = $dates;
			$myobj->clicks = 0;
			
			array_push($urlres,$myobj);
			unset($myobj);
		}
		else {
					http_response_code(400);
					echo $urlarray[$i];
					return;
		}
	}	
	echo json_encode($urlres);
		
?>