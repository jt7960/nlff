$(document).ready(function(){

    $('#user_status').load('users/user_status');

    //log in modal functions
    $('body').on('click', '#sign_in_link', function(e){
        e.preventDefault();
        var modal = document.getElementById('login_modal');
        modal.style.display = "block";
        //console.log(this.value);
    });
    
    $('body').on('click', '#close_login_modal', function(e){
        var modal = document.getElementById('login_modal');
        modal.style.display = 'none';
    });

    $('body').on('click', '#login_submit', function(e){
        e.preventDefault();
        var username = document.getElementById('login_username').value;
        var password = document.getElementById('login_password').value;
        console.log(username + password);
        var data = {'username':username, 'password':password};
        $.post('users/login', data, function(data,status,xhr){
            console.log(data);
            $('#user_status').load('users/user_status');
        });
        //$('#user_status').load('users/user_status');
        var modal = document.getElementById('login_modal');
        modal.style.display = 'none';
    });

    //register modal functions
    $('body').on('click', '#register_link', function(e){
        e.preventDefault();
        var modal = document.getElementById('register_modal');
        modal.style.display = 'block';
    });

    $('body').on('click', '#close_register_modal', function(e){
        var modal = document.getElementById('register_modal');
        modal.style.display = 'none';
    });

    $('body').on('click', '#register_submit', function(e){
        var username = document.getElementById('register_username').value();
        var username = document.getElementById('register_email').value();
        var username = document.getElementById('register_password').value();
    });

}); //end document.ready()