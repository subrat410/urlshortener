<?php
	if(isset($_GET['id'])){
		include 'functions.php';			//Makes the link work
		$id = $_GET['id'];
		$url = getUrlLocation($id);
		
		incrementCounter($id);
		header('Location: '.$url);			//Makes the necessary redirection
	}
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	$_SESSION['id'] = rand(10000,99999);
	
?>
<!doctype html>
<html lang="en">
<head>
	<title>URL Shortener</title>
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 

</head>
<body style="background-color: white;">
	<!-- Image and text -->
	<div class="row bg-dark">
		<nav class="col navbar navbar-light bg-dark">
		  <a class="navbar-brand text-light pl-5" href="#">
			<img src="favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="">
			URL Shortener
		  </a>
		</nav>
		</div>
	<div class="row justify-content-start bg-success">
		
			<div class="col mt-2 pl-5 ">
				<h1 class="font-weight-light text-light">Simplify your links</h1>
			</div>
	</div>
	<div class="row justify-content-start bg-success">		
			<div class="col-9 pl-5 input-group">
				<input class="mt-2 form-control" type="text" name="url" placeholder="Enter URL here or add them to Queue ">
				<input class="input-group-append btn bg-light mb-4 mt-2" type="submit" value=" + " name="add">
			</div>
			<div class="col-3">
				<input class="mt-2 pr-4 btn bg-light" type="submit" value="Shorten My URL!        " name="short">
			</div>
	</div>
	<div class="row justify-content-start bg-success">
			<div class="col-9 pl-5 input-group">
				<input class="mr-2 mb-1 form-control" type="text" placeholder="Enter multiple URLs seperated by (,)" name="shorturlsearch">
				<div class="w-100"></div>
				<small class="text-light mb-3">Ensure no spaces before or after URLs</small>

			</div>
			<div class="col-3">
				<input class="btn bg-light" type="submit" value="Retrieve Long URLs       " name="longer">
				
			</div>
	</div>
	
	
	<div class="container">
			
		<div class="bg-light"> 
			<table class="table table-bordered table-hover info mt-5" >
				<thead>
					<tr>
						<th scope="col">URL Queue <span class="text-primary font-weight-normal">( Add URLs using + button )<span></th>
					</tr>
				</thead>
				<tbody id = "urlQueue">
				</tbody>
			</table>
			
		</div>
		
		<small class="text-dark" style="float:right;">Refresh and Re-Enter URL for accurate clicks</small>
			<div>
				<table class="table table-dark table-bordered">
					<thead>
						<tr>
							<th>Original URL</th>
							<th>Date Created</th>
							<th>Short URL</th>
							<th>Clicks</th>
						</tr>
					</thead>
					<tbody id="tablecontent">
						
							
						
					</tbody>
				</table>
			</div>
		
		<div class="card mb-3 mt-5" style="max-width: 540px;">
			<div class="row no-gutters">
				<div class="col-md-4">
					<img src="Subrat.jpeg" class="card-img" alt="...">
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title">Subrat Mahim Saxena</h5>
						<p class="card-text"><span class="font-weight-bold">Contact: </span>9818500937<br><span class="font-weight-bold">Address: </span>203, C-4, Gulmohar Enclave, Nehru Nagar, Ghaziabad, Uttar Pradesh-201001</p>
						<p class="card-text"><small class="text-muted">Never Settle. Always Hustle</small></p>
					</div>
				</div>
			</div>
		</div>
		
						
	</div>
	<script type="text/javascript" src='control.js'></script>
</body>
</html>
