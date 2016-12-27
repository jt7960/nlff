$(document).ready(function(){

    $('body').on('click', '#login_submit', function(e){
        //console.log('submit clicked');
        e.preventDefault();
        var username = document.getElementById('username_field').value;
        var password = document.getElementById('password_field').value;
        var remember_me = document.getElementById('remember_me').checked;
        var data = {'username':username, 'password':password, 'remember_me': remember_me};
        $.post('../users/login', data, function(reply,status,xhr){
            console.log(reply);
            if(reply == 'true'){
                location.reload();
            }
            else{
                $('#loginModal').modal('show');
                $('#login_modal_status').text(reply);
            }
        });
    });

    //logout function
    $('body').on('click', '#logoutBtn', function(){
        var data = {};
        $.post('../users/logout', data, function(){
            window.location.replace("/");
        });
    });

    $('body').on('click', '#register_submit', function(e){
        e.preventDefault();
        var username = document.getElementById('register_username').value;
        var email = document.getElementById('register_email').value;
        var password = document.getElementById('register_password').value;
        var verify = document.getElementById('verify_register_password').value;
        var data = {'username':username, 'email':email, 'password':password, 'verify':verify};
        $.post('../users/register', data, function(reply, status, xhr){
            console.log(reply);
            if (reply =='true'){
                 $('#user_status').load('../users/user_status');
            }
            else{
                $('#loginModal').modal('show');
                $('#login_modal_status').text(reply);
            }
        })
    });





}); //end document.ready()