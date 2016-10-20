$(document).ready(function(){


    $('#user_status').load('users/user_status');

    $('body').on('click', '#sign_in_link', function(e){
        e.preventDefault();
        var modal = document.getElementById('login_modal');
        modal.style.display = "block";
        //console.log(this.text);
    });
    
    $('body').on('click', '#close_login_modal', function(e){
        var modal = document.getElementById('login_modal');
        modal.style.display = 'none';
    });

    $('body').on('click', '#login_submit_button', function(e){
        e.preventDefault();
        var username = document.getElementById('username_input');
        var password = document.getElementById('password_input');
        var data = {'username':username, 'password':password};
        $.post('users/login', data, function(data,status,xhr){
            console.log(data);
            $('#user_status').load('users/user_status');
        });
        //$('#user_status').load('users/user_status');
        var modal = document.getElementById('login_modal');
        modal.style.display = 'none';
    })



}); //end document.ready()