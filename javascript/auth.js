$(document).ready(function(){

    //logout function
    $('body').on('click', '#logoutBtn', function(){
        console.log('hello');
        var data = {};
        $.post('../users/logout', data, function(){
            window.location.replace("/");
        });
    });

    if($('#login_modal_status').text() != ''){
        $('#loginModal').show();
    }

}); //end document.ready()