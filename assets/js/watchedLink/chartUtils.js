module.exports.scaleToMoment = {'Y':'year', 'm':'month', 'd':'day', 'H':'hour', 'i':'minute', 's':'second'};
module.exports.dateFormat = 'YYYY-MM-DD';

// Function that transform a php date scale (Y, m, d, H, i, s) to the Moment.js format used in this application
module.exports.scaleToMomentFormat = function(scale){
    format = "";
    switch (scale) {
        case "s":
            format = ":ss" + format;		
        case "i":
            format = ":mm" + format;
        case "H":
            format = ":HH" + format;
        case "d":
            format = ":DD" + format;
        case "m":
            format = ":MM" + format;
        case "Y":
            format = "YYYY" + format;
            break;
        default:
            return "Scale not found";
    }
    return format;
}

// Look for a datetime in data Json array.
module.exports.getVisits = function(data, datetime){
    for(var x in data){
        if(data[x].datetime && data[x].datetime == datetime) return data[x].visits;
    }
    return 0;

}

// Function to copy a string to the clipboard
module.exports.copyStringToClipboard = function(str) {
    // Create new element
    var el = document.createElement('textarea');
    // Set value (string to be copied)
    el.value = str;
    // Set non-editable to avoid focus and move outside of view
    el.setAttribute('readonly', '');
    el.style = {position: 'absolute', left: '-9999px'};
    document.body.appendChild(el);
    // Select text inside element
    el.select();
    // Copy text to clipboard
    document.execCommand('copy');
    // Remove temporary element
    document.body.removeChild(el);
}


// Get Data from the server and refresh chart
module.exports.getDataAjaxObject = function(linkId, startDateTime, endDateTime, scale, chart){
    return {
        url: "/visits/" + linkId + "/" + startDateTime.format(this.dateFormat) + "/" + endDateTime + "/" + scale,
        type: 'GET',
        dataType: 'json',
        context:this,
        success: function(data, state){
            chartData = [];
        
            while(startDateTime.isBefore(endDateTime, this.scaleToMoment[scale])){
                // 0 if not found. Else number of visits 
                valueToPush = this.getVisits(data, startDateTime.format(this.scaleToMomentFormat(scale)));
                chartData.push({
                    t: startDateTime.valueOf(),
                    y: valueToPush
                });
                // Add 1 unity of the scale
                startDateTime = startDateTime.clone().add(1, this.scaleToMoment[scale]+"s");
            }
        
            // Affecting new data to chart data
            chart.data.datasets[0].data = chartData;
            // Refresh view of chart

            chart.update();
        },
        error : function(result, state, error){
            // TO DO: display error message to user
            console.log(result.responseText);
            console.log(state);
            console.log(error);
        }
    };
};
