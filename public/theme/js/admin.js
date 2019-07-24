$( document ).ready(function() {
    console.log( "ready!" );


    $('form').on('submit', function() {
        $.LoadingOverlay('show');
    });

});
