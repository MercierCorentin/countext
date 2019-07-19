// Requirements
const $ = require('jquery');
require('popper.js');
require('bootstrap');
var stringSimilarity = require('string-similarity');

$(function(){
    $(".search-bar").on('input', function(){
        
        // declare and init vars
        var searchValue = $(this).val();

        // Search value transformation
        searchValue = searchValue.toLowerCase();
        searchValue = searchValue.trim();

        // Get all titles in JQuery elements
        var JQueryTitles = $("article h3");

        // Get all titles text
        JQueryTitles.each( function(){
            
            var currentValue = $(this).html();
            currentValue = currentValue.toLowerCase();

            var similarity = stringSimilarity.compareTwoStrings(currentValue, searchValue);
            
            if( similarity > 0.75 )
            {
                JQueryTitles.parent().hide();
                $(this).parent().show();
                return false;
            }
            else
            {
                $(this).parent().show();
            }
        });
    })
});
