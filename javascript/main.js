(function($) {
    $(document).ready(function() {
        $('pre').each(function(i, elem) {
            var code=$(elem).find('code[class^=language]');
            
            if(code.length>0) {
                var brush=code.attr('class').replace('language-', '');
                $(elem).attr('class', 'prettyprint lang-'+brush);
            }
        });
    });
})(jQuery);