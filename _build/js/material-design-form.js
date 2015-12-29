jQuery(document).ready(function($) {	
	/*------------------------------------------------------------------
	Material Design Form
	-------------------------------------------------------------------*/

	//* When page is loaded, check if input fields and textareas have content
	$('.comment-form input, .comment-form textarea').each( function() {
		if ( $(this).val() !== '' )
   			$(this).prev('label').addClass('superscript');
   	});

	//* Input on focus
   	$('.comment-form input, .comment-form textarea').focus(function() {
   		$(this).prev('label').addClass('superscript');
   	});

   	//* Input lose focus (blur)
   	$('.comment-form input, .comment-form textarea').blur(function() {
   		if ( $(this).val() === '' )
   			$(this).prev('label').removeClass('superscript');
   	});

	
	//* Prepare all textareas for autosize
	$('.sce-edit-button').on('click', 'a', function() {
		console.log('test');
		$('.sce-textarea').css('display', 'block');
		// $('.sce-textarea').css('background-color', 'black');
		$('.sce-textarea textarea').css('overflow-y', 'hidden');
		autosize($('.sce-textarea textarea'));
	});
	$('textarea').attr('rows', '2');
	// from a jQuery collection
   	//* Autosize Textarea
	autosize($('textarea'));

	// overflow-x: hidden; word-wrap: break-word; resize: none; overflow-y: visible;
	// overflow: hidden; word-wrap: break-word; resize: none; height: 101px;


	//* When click on bewerk comment, make textarea autosize...
	// .css('overflow-y', 'hidden')



	//* Werkt niet. Waarom weet ik niet..
	// $('.comment-form input').on( "focus", function() {
	// 	$(this).prev('label').addClass('superscript');
	// });

	// $('.comment-form input').off( "focus", function() {
	// 	if ( $(this).val() == '' )
	// 		$(this).prev('label').removeClass('superscript');
	// });
});