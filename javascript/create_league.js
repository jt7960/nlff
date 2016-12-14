$(document).ready(function(){
    $('#pw_div').hide();


    $('body').on('click', '.radio_public_private', function(){
        if(this.value == true){
            $('#pw_div').slideUp();
        }
        if(this.value == false){
            $('#pw_div').slideDown();
        }
    });

    //$('#')
});