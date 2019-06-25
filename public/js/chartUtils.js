// Colors
window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

// Function that transform a php scale (Y, m, d, H, i, s) to the Moment.js format used in this application
function scaleToMomentFormat(scale){
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
            return "Scale not found"
            break;
    }
    return format;
}

// Look for a datetime in data Json array.
function getVisits(data, datetime){
    for(var x in data){
        if(data[x].datetime && data[x].datetime == datetime) return data[x].visits;
    }
    return 0;

}

// Function to copy a string to the clipboard
function copyStringToClipboard(str) {
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
