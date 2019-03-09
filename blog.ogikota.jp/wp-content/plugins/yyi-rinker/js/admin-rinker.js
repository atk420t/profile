(function($) {
    $(document).on( 'click', '.yyi-rinker-confirm-link', function ( event ) {
        var url = $(this).parent().find('input').val();
        window.open(url, '_blank');
        return false;
    });
})(jQuery);

(function($) {

    $(document).on( 'click', 'textarea.yyi-rinker-list-shortcode', function ( event ) {
        $(this).select();
        document.execCommand('copy');
    });

    $(document).on( 'click', 'textarea.yyi-rinker-term-list-shortcode', function ( event ) {
        $(this).select();
        document.execCommand('copy');
    });
})(jQuery);

