// autocomplete : this function will be executed every time we change the text
function autocomplet() {
	var keyword = $('#variable_code').val();
	$.ajax({
		url: 'autocomplete.php',
		type: 'POST',
		data: {keyword:keyword},
		success:function(data){
			$('#question_list').show();
			$('#question_list').html(data);
		}
	});
}

// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	$('#variable_code').val('');
	// hide proposition list
	$('#question_list').hide();
}

