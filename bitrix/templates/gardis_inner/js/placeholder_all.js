jQuery(function(){
	var $fields = jQuery('input[placeholder], textarea[placeholder], text[placeholder]');
	if($fields.length) $fields.placeholder();
});