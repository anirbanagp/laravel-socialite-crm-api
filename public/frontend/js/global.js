
/* Global js start */

$(document).ready(function(){
	// show sidebar
	$('.s_sidebar').click(function(){
		$('.sidebar').addClass('show');
	});
	$('.close_s').click(function(){
		$('.sidebar').removeClass('show');
	});
	// nav bar active
	$('.nav_item').on('click', function(){
		$('.nav_item.active').removeClass('active');
		$(this).addClass('active	');
	});
	setTimeout(function(){
		$(".messages").addClass('remove_messages');
	},5000)

});
function showAlert(title=null,content=null,type='blue') {
	$.alert({
		icon: 'fa fa-warning',
		title: title,
		content : content,
		type  : type,
		theme:'material',
		closeIcon: true,
		closeIconClass: 'fa fa-close',
		draggable: false,
	});
}
function showError(content) {
	title = $('#error_title').attr('data-value');
	$.alert({
		icon: 'fa fa-warning',
		title: title,
		content : content,
		type  : 'red',
		theme:'material',
		closeIcon: true,
		draggable: false,
		closeIconClass: 'fa fa-close'
	});
}
function showSuccess(content) {
	title = $('#success_title').attr('data-value');
	$.alert({
		icon: 'fa fa-check-circle',
		title: title,
		content : content,
		type  : 'green',
		theme:'material',
		draggable: false,
		closeIcon: true,
		closeIconClass: 'fa fa-close'
	});
}
function showInfo(content) {
	title = $('#info_title').attr('data-value');
	$.alert({
		icon: 'fa fa-info-circle',
		title: title,
		content : content,
		type  : 'blue',
		theme:'material',
		draggable: false,
		closeIcon: true,
		closeIconClass: 'fa fa-close'
	});
}
