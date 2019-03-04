<?php  
	function idExists($id){
		include 'init.php';
		$row = $conn->query("SELECT * FROM urlresults WHERE id = '$id'");

		if($row->num_rows > 0){
			return true;
		} else {
			return false;
		}
	}

	function urlHasBeenShortened($url){
		include 'init.php';
		$row = $conn->query("SELECT * FROM urlresults WHERE Original = '$url'");

		if($row->num_rows > 0){
			return true;
		} else {
			return false;
		}
	}
	
	function urlvalidator($url){
			$x = filter_var($url, FILTER_VALIDATE_URL);
			if($x == $url){
				return true;
			} else false;
	}
	
	function urlSplitter($urlstring){
		$urlarray = explode(",",$urlstring);
		return $urlarray;
	}

	function getURLID($url){
		include 'init.php';
		$row = $conn->query("SELECT id FROM urlresults WHERE Original = '$url'");

		return $row->fetch_assoc()['id'];
	}

	function insertID($id, $url){
		date_default_timezone_set('UTC');
		include 'init.php';
		$dated = date("d/m/Y");
		$conn->query("INSERT INTO urlresults (id, Original,Date) VALUES ('$id', '$url','$dated')");

		if(strlen($conn->error) == 0){
			return true;
		}
	}
	
	function getDates($id){
		include 'init.php';
		$row = $conn->query("SELECT Date FROM urlresults WHERE id = '$id'");
		
		return $row->fetch_assoc()['Date'];
	}

	function getUrlLocation($id){
		include 'init.php';
		$row = $conn->query("SELECT Original FROM urlresults WHERE id = '$id'");

		return $row->fetch_assoc()['Original'];
	}
	function incrementCounter($id){
		include 'init.php';
		$row = $conn->query("SELECT clicks FROM urlresults WHERE id = '$id'");
		
		$count = $row->fetch_assoc()['clicks'];
		
		$count++;
		
		$row = $conn->query("UPDATE urlresults SET clicks = '$count' WHERE id = '$id'");
		return true;
	}
	function getClicks($id){
		include 'init.php';
		$row = $conn->query("SELECT clicks FROM urlresults WHERE id = '$id'");
		
		return $row->fetch_assoc()['clicks'];
	}
	
?>