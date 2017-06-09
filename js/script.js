$(document).ready(function () {
	$('.col-md-7 .btn-primary').mouseenter(function () {
		$(this).animate({width: "200px"}, 'fast');
	});
	$('.col-md-7 .btn-primary').mouseleave(function () {
		$(this).animate({width: "118px"}, 'fast');
	});
	
	
	$(document).ready(function () {
	//$('#searchBox').hide();
	var searchBoxvar = "<div class='well' id='searchBox'>" +
                    "<form action='search.php' method='post'>" +
                    	"<div class='input-group'>" +
							"<input name='search' placeholder='Search Blog' type='text' class='form-control'>" +
							"<span class='input-group-btn'>" +
								"<button name='submit' class='btn btn-default' type='submit'>" +
									"<span class='glyphicon glyphicon-search'></span>" +
								"</button>" +
                        	"</span>" +
                    	"</div>" +
                    "</form>" +
              
               " </div>	";

	$(window).on('load', function () {
			$('#intro').delay(1000).fadeOut('medium', function () {
				$('#searchBox').append(searchBoxvar).hide().fadeIn('medium');
			});
		
		});
		
	});
	
});