jQuery( function( $ ) {

    $( '#misha_file' ).change( function() {

        if ( ! this.files.length ) {
            $( '#misha_filelist' ).empty();
        } else {

            // we need only the only one for now, right?
            const file = this.files[0];

            $( '#misha_filelist' ).html( '<img src="' + URL.createObjectURL( file ) + '"><span>' + file.name + '</span>' );

            const formData = new FormData();
            formData.append( 'misha_file', file );

            $.ajax({
                url: wc_checkout_params.ajax_url + '?action=mishaupload',
                type: 'POST',
                data: formData,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function ( response ) {
                    $( 'input[name="misha_file_field"]' ).val( response );
                }
            });

        }

    } );

} );