jQuery(document).ready(function($){

    /*********************************
     * Keurmerk add/remove/move
     *********************************/
    //* Set keurmerknumber to pass on to inserted keurmerk 
    var new_keurmerk_number = $( ".keurmerken-table tbody tr" ).length;

    //* Add keurmerk
    $( "#add_keurmerk" ).on('click', function(e) {

        e.preventDefault();

        process_clone_number();
        clone_the_keurmerk_clone();
    });

    function process_clone_number() {
        $(".keurmerk-clone .keurmerk-name").attr("name", "keurmerken[" + new_keurmerk_number + "][name]");
        $(".keurmerk-clone .upload-image-id").attr("name", "keurmerken[" + new_keurmerk_number + "][image_id]");
        $(".keurmerk-clone .keurmerk-link").attr("name", "keurmerken[" + new_keurmerk_number + "][link]");
        new_keurmerk_number++;
    }

    function clone_the_keurmerk_clone() {
        $(".keurmerk-clone").clone().attr('class', 'keurmerk').appendTo( $( ".keurmerken-table tbody" ) );
    }

    //* Remove keurmerk
    //* Call from parent to enable removal of dynamicly added keurmerken
    $( ".keurmerken-table" ).on('click', '.remove-keurmerk', function(e) {

        e.preventDefault();

        $(this).closest("tr").remove();
    });

    //* Move keurmerk
    $( ".keurmerken-table tbody" ).sortable({
        revert: true,
        handle: ".move-keurmerk",
    });

 
    /*********************************
     * Media popup
     *********************************/
    var custom_uploader;
 
 
    $( ".keurmerken-table" ).on('click', '.upload-image-button', function(e) {
 
        e.preventDefault();

        //* The field to return the output
        var returnField1 = $(this).closest(".keurmerk").find(".image-holder");
        var returnField2 = $(this).closest(".keurmerk").find(".upload-image-id");
 
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

            var attachmentWidth, attachmentHeight, attachmentUrl = '';
            if (attachment.sizes.hasOwnProperty('thumbnail')) {
                attachmentWidth = attachment.sizes.thumbnail.width;
                attachmentHeight = attachment.sizes.thumbnail.height;
                attachmentUrl = attachment.sizes.thumbnail.url;
            }
            else {
                attachmentWidth = attachment.sizes.full.width;
                attachmentHeight = attachment.sizes.full.height;
                attachmentUrl = attachment.sizes.full.url;
            }

            var returnImage = '<img class="attachment-thumbnail" width="'+ attachmentWidth +'" height="'+ attachmentHeight +'" alt="'+ attachment.name +'" src="'+ attachmentUrl +'">';
            returnField1.html(returnImage);
            returnField2.val(attachment.id);

        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
 
});