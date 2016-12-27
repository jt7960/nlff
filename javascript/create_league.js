$(document).ready(function(){
    $('#private_league_div').hide();


    $('body').on('click', '.radio_public_private', function(){
        if(this.value == true){
            $('#private_league_div').slideUp();
        }
        if(this.value == false){
            $('#private_league_div').slideDown();
        }
    });

    $( "#draft_date" ).datepicker();

});