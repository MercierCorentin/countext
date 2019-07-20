import moment from 'moment';
import $ from 'jquery';
import 'popper.js';
import 'bootstrap';
import Chart from 'chart.js'
import * as chartUtils from './chartUtils';
import * as chartInit  from './chartInit';

$(function(){
    // Create chart
    var chart = new Chart(chartInit.ctx, chartInit.cfg);


    // Get current watched link ID
    var watchedLinkId = $("#watched-link-id").val();

    // Create dates
    var initStartDate = moment().subtract(3, "months");
    var initEndDate   = moment().add(1, "months").format(chartUtils.dateFormat);
    console.log(initStartDate);
    
    // Display right data on chart
    chartUtils.getData(watchedLinkId, initStartDate , initEndDate, "m", chart);

    
    // Filling inputs
    $("#start-date").val(initStartDate.format(chartUtils.dateFormat));
    $("#end-date").val(initEndDate);

    // //
    // Events
    // //
    $('#update').on('click', function() {

        // Update type
        var type = document.getElementById('type').value;
        chart.config.data.datasets[0].type = type;
        chart.update();

        // Update data
        var startDate 	= $("#start-date").val();
        var endDate		= $("#end-date").val();
        var scale 		= $("#scale").val();
        var linkId 		= watchedLinkId;
        chartUtils.getData(linkId, moment(startDate, chartUtils.dateFormat) , endDate, scale, chart);
    });

    // Click to copy event
    $(".click-to-copy").on('click', function(){
        chartUtils.copyStringToClipboard($(this).text());	
    });
});
