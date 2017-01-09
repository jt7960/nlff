$(document).ready(function(){
    //logout function
    $('body').on('click', '#logoutBtn', function(){
        //console.log('hello');
        var data = {};
        $.post('../users/logout', data, function(){
            window.location.replace("/");
        });
    });

    $('body').on('click', '#login_submit', function(e){
        e.preventDefault();
        var username = $('#login_username').val();
        var password = $('#login_password').val();
        var page = $('#page').val();
        var remember_me = $('#remember_me').prop('checked');
        var data = {'username':username, 'password':password, 'remember_me':remember_me, 'page':page};
        $.post('/users/login', data, function(status){
            if(status != ''){
                $('#login_modal_status').html(status);
            }
            else{
                location.reload();  
            }
        });
    });

    $('body').on('click', '#register_submit', function(e){
        e.preventDefault();
        var username = $('#register_username').val();
        var password = $('#register_password').val();
        var verify_password = $('#verify_register_password').val();
        var email = $('#register_email').val();
        var verify_email = $('#verify_register_email').val();
        var page = $('#page').val();
        var data = {'username':username, 'password':password, 'verify_password':verify_password, 'email':email, 'verify_email':verify_email, 'page':page};
        $.post('/users/register', data, function(status){
            if(status != ''){
                $('#login_modal_status').html(status);
            }
            else{
                location.reload();
            }
        })
    });

}); //end document.ready()