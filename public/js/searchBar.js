$(function(){
    $(".search-bar").on('input', function(){
        
        // declare and init vars
        var searchValue = $(this).val()
        var titles = [];

        // Search value transformation
        searchValue = searchValue.toLowerCase();
        searchValue = searchValue.trim();

        // Get all titles in JQuery elements
        var JQueryTitles = $("article h3");

        // Get all titles text
        JQueryTitles.each( function(){
            
            var currentValue = $(this).html();
            currentValue = currentValue.toLowerCase();

            if( currentValue === searchValue){
                JQueryTitles.parent().hide();
                $(this).parent().show();
            }
        });
    })
});