$(document).ready(function(){
			
			
			var longurlarr = [];
			
			$('input[name="add"]').click(function(e){			//CLICK FUNCTION(ADDING URL INTO QUEUE THROUGH '+' SIGN)
					e.preventDefault();
					if($('input[name="url"]').val()){
						var oneurl = $('input[name="url"]').val();
						var j = 0;
						
						displayOverlay("Adding...");
						$.ajax({
							url: 'urlvalidator.php',
							type: 'POST',
							data: {url : oneurl},
							error: function(xhr){
										alert("An error occurred: "+ xhr.status + " " + xhr.statusText);
										removeOverlay();
										}
								}).done( function(data){
									
											if(data){
												longurlarr.push(data);
										
												$('#urlQueue').append('<tr><td><a href="' + longurlarr[longurlarr.length-1] + '" target="_blank">' + longurlarr[longurlarr.length-1] + '</a></td></tr>');
																	//appending recently added element only
											}
									
										removeOverlay();
									});
						
						$('input[name="url"]').val("");    		//resetting input field
					} else {
						alert("Feed me URL first!");
					}
			});
				
						
				
			
			
			$('input[name="short"]').click( function(e){		//CLICK FUNCTION TO PROCESS URL
				e.preventDefault();								//prevents default functioning like submit
			
				$('#urlQueue').html('');		//

				if($('input[name="url"]').val()){
						longurlarr.push($('input[name="url"]').val());
						$('.longurls').append('<li><a href="' + longurlarr[longurlarr.length-1] + '">' + longurlarr[longurlarr.length-1] + ' target="_blank"</a></li>');
						//appending recently added element only
				}
					
				
				if(longurlarr.length !== 0)
				{
					var json_obj ={};
					for(let i = 0; i < longurlarr.length; i++){
						json_obj[i] = longurlarr[i];			//json object creation
					}
					var json_data = JSON.stringify(json_obj);   //converting json object to string
					//alert(json_data);
						displayOverlay("Processing...");			//Overlay can be used to show buffering when input is huge.
						
						$.ajax({
							url: 'process.php',
							type: 'POST',
							data: {array: json_data},
							error: function(xhr)
									{
										alert("An error occurred: "+ xhr.status + " " + xhr.statusText + " Link: " + xhr.responseText);
										$('input[name="url"]').val("");
										removeOverlay();
									}
						}).done(function(data) {
										
										var urlres = JSON.parse(data,true);											//parsing data obtained in json from server
										
										$.each(urlres,function(k,v){
											
												$('#tablecontent').append('<tr><td><a href="'+v.Original+'">'+ v.Original +'</a></td> <td>'+ v.dates +'</td> <td><a href="https://' + v.Short + '" target="_blank">'+ 'https://' + v.Short + '</a></td> <td>' + v.clicks+ '</tr>')
										
										})
										
										removeOverlay();
										$('input[name="url"]').val("");
										
									}); 
				}
				else{
					alert("C'mon atleast enter a URL first!");
				}
					longurlarr = [];
				});
				
				
				
				$('input[name="longer"]').click(function(e){		//CLICK FUNCTION FOR REVERSE PROCESSING
					
					$('.shortlong').html('<p>SHORT TO LONG</p>');
					
					e.preventDefault();
					
					if($('input[name="shorturlsearch"]').val())
					{	
						var shortarr = $('input[name="shorturlsearch"]').val().split(",");		//splitter
						
						var json_obj = {};
						for(let i = 0; i < shortarr.length; i++){
							json_obj[i] = shortarr[i];
						}
						
						var json_data = JSON.stringify(json_obj);
						displayOverlay("Processing...");
						$.ajax({
							url: 'revertprocess.php',
							type: 'POST',
							data: {array: json_data},
							error: function(xhr)
									{
										alert("An error occurred: "+ xhr.status + " " + xhr.statusText + " Link: " + xhr.responseText);
										$('input[name="shorturlsearch"]').val("");
										removeOverlay();
									}
						}).done(function(data){
								if(data){
									
									var shorturlres = JSON.parse(data,true);
									
									$.each(shorturlres,function(k,v){
										$('#tablecontent').append('<tr><td><a href="'+v.Original+'">'+ v.Original +'</a></td> <td>'+ v.dates +'</td> <td><a href="https://' + v.Short + '" target="_blank">'+ v.Short + '</a></td> <td>' + v.clicks+ '</tr>')
									}) 
							}
							$('input[name="shorturlsearch"]').val("");
							removeOverlay();
						})
						
						shortarr = [];
					}
					else {
						alert("Whoops! Its Empty. Please Enter Short URLs.");
					}
				})
		});
			
			
		function displayOverlay(text) {
			$("<table id='overlay'><tbody><tr><td>" + text + "</td></tr></tbody></table>").css({
				"position": "fixed",
				"top": 0,
				"left": 0,
				"width": "100%",
				"height": "100%",
				"background-color": "rgba(0,0,0,.5)",
				"z-index": 10000,
				"vertical-align": "middle",
				"text-align": "center",
				"color": "#fff",
				"font-size": "30px",
				"font-weight": "bold",
				"cursor": "wait"
			}).appendTo("body");
		}

		function removeOverlay() {
			$("#overlay").remove();
		}
		