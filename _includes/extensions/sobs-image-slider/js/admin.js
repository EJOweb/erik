jQuery(document).ready(function($){
 
    /*********************************
     * Slide add/remove/move
     *********************************/
    //* Set slidenumber to pass on to inserted slide 
    var new_slide_number = $( ".image-slider-table tbody tr" ).length;

    //* Add slide
    $( "#add_slide" ).on('click', function(e) {

        e.preventDefault();

        process_clone_number();
        clone_the_slide_clone();
    });

    function process_clone_number() {
        $(".slide-clone .slide-name").attr("name", "image-slider[" + new_slide_number + "][name]");
        $(".slide-clone .upload-image-id").attr("name", "image-slider[" + new_slide_number + "][image_id]");
        $(".slide-clone .slide-link").attr("name", "image-slider[" + new_slide_number + "][link]");
        new_slide_number++;
    }

    function clone_the_slide_clone() {
        $(".slide-clone").clone().attr('class', 'slide').appendTo( $( ".image-slider-table tbody" ) );
    }

    //* Remove slide
    //* Call from parent to enable removal of dynamicly added slides
    $( ".image-slider-table" ).on('click', '.remove-slide', function(e) {

        e.preventDefault();

        $(this).closest("tr").remove();
    });

    //* Move slide
    $( ".image-slider-table tbody" ).sortable({
        revert: true,
        handle: ".move-slide",
    });

 
    /*********************************
     * Media popup
     *********************************/
    var custom_uploader;
 
 
    $( ".image-slider-table" ).on('click', '.upload-image-button', function(e) {
 
        e.preventDefault();

        //* The field to return the output
        var returnField1 = $(this).closest(".slide").find(".image-holder");
        var returnField2 = $(this).closest(".slide").find(".upload-image-id");
 
        //If the uploader object has already been created, reopen the dialog
        // if (custom_uploader) {
        //     custom_uploader.open();
        //     return;
        // }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();

            var returnImage = '<img class="attachment-thumbnail" width="'+ attachment.sizes.thumbnail.width +'" height="'+ attachment.sizes.thumbnail.height +'" alt="'+ attachment.name +'" src="'+ attachment.sizes.thumbnail.url +'">';
            returnField1.html(returnImage);
            returnField2.val(attachment.id);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});