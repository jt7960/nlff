$(document).ready(function(){
    update_join_league_panel();
    
    $('body').on('change', 'input:radio[name=league_type]', function(){
        update_join_league_panel();
    });

    $('body').on('click', '.load_join_league_form_link', function(e){
        e.preventDefault();
        var league_id = $(this).attr('league_id');
        var password = $(this).attr('password');
        load_join_league_form(league_id, password);
    });

    $('body').on('click', '#load_join_league_form_submit', function(e){
        e.preventDefault();
        var league_id = $('#league_id_input').val();
        var password = $('#password_input').val();
        load_join_league_form(league_id, password);
    });


});

function update_join_league_panel(){
    var league_type = $("input:radio[name=league_type]:checked" ).val();
    $('#join_league_form_title').text('Join ' + league_type + ' League');
    if(league_type == 'Public'){
        $('#join_league_form').hide();
        $('#private_panel_body').hide();
        $('#public_panel_body').show();
    }
    if(league_type == 'Private'){
        $('#join_league_form').hide();
        $('#public_panel_body').hide();
        $('#private_panel_body').show();
    }
}

function load_join_league_form(league_id, password){
    data = {'league_id':league_id, 'password':password};
    $('#private_panel_body').hide();
    $('#public_panel_body').hide();
    $('#join_league_form').load('/home/load_join_league_form', data, function(){

    });
    $('#join_league_form').show();

}
