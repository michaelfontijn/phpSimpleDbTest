
$(document).on('click' ,'.submitTest', function(){

    console.log('You have clicked me!');

    var form = $(this).parents('form');
    var formData = form.serialize();

    $.post('endpoint.php', {action : "insertUser", user : formData}, function(data){
        console.log(data);
    });

})