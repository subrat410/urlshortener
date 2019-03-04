<?php
	include 'functions.php';

	$shorturlarray = json_decode($_POST['array'],true);
	
	$shorturl = array();
	for($i = 0 ; $i < sizeof($shorturlarray); $i++){
		if(strlen($shorturlarray[$i]) > 50 && urlvalidator($shorturlarray[$i])=== true)
		{
			$id = str_split($shorturlarray[$i],47);	
													//47 initial characters in this localhost link
			$myobj = new stdClass();
			if(getUrlLocation($id[1]) !== null){
				$myobj->Original = getUrlLocation($id[1]);
				$myobj->Short = $shorturlarray[$i];
				$myobj->dates = getDates($id[1]);
				$myobj->clicks = getClicks($id[1]);
				
				array_push($shorturl, $myobj);
				
			}
			else if(getUrlLocation($id[1]) === null)
					{			
						http_response_code(404);
						echo $shorturlarray[$i];
						return;
					}
			unset($myobj); 
		}else {
					http_response_code(400);
					echo $shorturlarray[$i];
					return;
		}
	}
	//echo sizeof($shorturl);
	//echo json_encode($id);
	echo json_encode($shorturl);

?>