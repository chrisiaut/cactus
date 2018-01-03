var timer;
var checkinterval = 10;//sek

jQuery.ajaxSetup({ cache: false });

function pad(num, size) {
    var s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
}

function loadData()
{
    $.get( "backend.php?getstatus=1", function( data ) {
        $.each(data, function(led, status) {
            $('#led'+led).attr('checked', (status==1?true:false));
        })
    }, "json" );
}

$(document).ready(function() {

    $('.led').change(function() {
        var status = this.checked;
        var led = $(this).attr('led');
        console.log(led+" changed to "+status);
        $.get( "backend.php?lamp="+led+"&status="+(status==true?1:0), function( data ){
            
        }, "json" );
    });
});

timer = setInterval(function(){
    loadData();
},checkinterval*1000);