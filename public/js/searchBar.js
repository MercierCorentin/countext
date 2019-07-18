$(function(){
    $(".search-bar").on('input', function(){
        
        // declare and init vars
        var searchValue = $(this).val().toLowerCase();
        var titles = [];

        // Get all titles in JQuery elements
        var JQueryTitles = $("article h3");

        // Get all titles text
        JQueryTitles.each( function(){
            titles.push($(this).html().toLowerCase()); 
        });
    })
});