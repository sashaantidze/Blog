tinymce.init({ selector:'textarea' });

$(document).ready(function(){
	
	$('#selectAllBoxes').click(function(){
		if(this.checked){
			$('.checkboxes').each(function(){
				this.checked = true;
			});
		}
		else{
			$('.checkboxes').each(function(){
				this.checked = false;
			});
		}
	});
	
	
	$('#bulkOptions').on('change', function() {
		var bulkValue = $(this).val();
		var btnAttr = $('#optionBtn');
		
		switch(bulkValue){
			case 'published':
				btnAttr.attr("value", "Publish");
				break;
			case 'draft':
				btnAttr.attr("value", "Draft");
				break;
			case 'delete':
				btnAttr.attr("value", "Delete");
				break;	
			case 'clone':
				btnAttr.attr("value", "Clone");
				break;
			default:
				btnAttr.attr("value", "Apply Option");
				
		}
	});
	
	$(document).ready(function(){
			var div_box = "<div id='load-screen'><div id='loading'></div></div>";

			$("body").prepend(div_box);
			$('#load-screen').delay(700).fadeOut(600, function(){
				$(this).remove();
			});
		});
	
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	
});

