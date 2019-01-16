$(document).ready(function() {

    /**** Initialize JQuery Form Validation ****/
    $.validate({
        modules: 'file, date'
    });

    /**** Initialize Bootstrap Select ****/
    $('.selectpicker').selectpicker();
    /** Refresh all bootstrap selects when reset form **/
    $('form').on('reset', function () {
        $('label[class=input-file]').html('Selecionar Imagem');
        $('.selectpicker').val('default');
        $('.selectpicker').selectpicker('refresh');
    });

    /**** Search Forms ****/
    /** Submit form when limit select is changed **/
    $('select[name=limit]').on('change', function () {
        $('form[name=searchform]').submit();
    });

    /** Submit form when limit orderBy is changed **/
    $('select[name=orderBy]').on('change', function () {
        $('form[name=searchform]').submit();
    });

    /** Submit form when type album is changed **/
    $('select[name="data[3]"]').on('change', function () {
       $('form[name=searchform]').submit();
    });

    /****	Custom File Input ****/
    /** Show image name on Label **/
    var logo_band = $("input[name=logo_band]");
    var photo_band = $("input[name=photo_band]");
    var cover_album = $("input[name=cover_album]");

    if (logo_band) {
        logo_band.on('change', function (e) {
            $( "label[for=logo_band]" ).html( e.target.files[0].name );
        });
    }

    if (photo_band) {
        photo_band.on('change', function (e) {
            $( "label[for=photo_band]" ).html( e.target.files[0].name );
        });
    }

    if (cover_album) {
        cover_album.on('change', function (e) {
            $( "label[for=cover_album]" ).html( e.target.files[0].name );
        });
    }

} );