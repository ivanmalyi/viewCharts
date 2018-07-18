//Menu Toggle
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

setInterval(function()
{
    $("#tableSkid").load(" #tableSkid>*");
}, 5000);

//input calendar
$( function() {
    CALENDAR.bind(
        document.getElementById("startTime"),
        {
            showTime:	true,
            ssTime:		true
        }
    );

    CALENDAR.bind(
        document.getElementById("endTime"),
        {
            showTime:	true,
            ssTime:		true
        }
    );
} );
/*
function fillModalWindow(idRow) {
    $("#modalData").html($("#" + idRow).html()).children().removeAttr("class");
}
*/