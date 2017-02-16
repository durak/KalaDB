$(document).ready(function () {
    //alert('Hello World!');
});

$(document).ready(function ()
{
    $("#testTable").tablesorter();
    $("#luresTable").tablesorter({
        // sort on the first column, order asc 
        sortList: [[0, 0]]
    });
    $("#fishTable").tablesorter({
        // sort on the second column, order asc 
        sortList: [[1, 0]],
        // disable first column sorting
        headers: {
            0: {sorter: false}
        }
    });
}


);

