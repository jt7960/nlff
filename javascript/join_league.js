$(document).ready(function(){
    update_join_league_panel();

    $('body').on('change', 'input:radio[name=league_type]', function(){
        update_join_league_panel();
    });


});

function update_join_league_panel(){
    var league_type = $("input:radio[name=league_type]:checked" ).val();
    $('#join_league_form_title').text('Join ' + league_type + ' League');
    if(league_type == 'Public'){
        $('#private_panel_body').hide();
        $('#public_panel_body').show();
    }
    if(league_type == 'Private'){
        $('#public_panel_body').hide();
        $('#private_panel_body').show();
    }
}