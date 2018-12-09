
$(document).on('click' ,'.submitTest', function(){

    console.log('You have clicked me!');

    var form = $(this).parents('form');
    var formData = form.serialize();

    $.post('endpoint.php', {action : "insertUser", user : formData}, function(data){
        console.log(data);
        reloadUsers()
    });

})

function reloadUsers(){
    $.get('endpoint.php', {action: "getUsers"}, function(data){
        var placeholder = $('#userPlaceholder');
        placeholder.html("");
        placeholder.append(data);
    })
}


$(function(){
    reloadUsers();
})