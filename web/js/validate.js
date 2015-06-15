$(document).ready(function () {
    $('form').validate({
        rules: {
            'test_crudbundle_user[firstName]': {
                required: true
            },
            'test_crudbundle_user[lastName]': {
                required: true
            },
            'test_crudbundle_user[age]': {
                required: true,
                digits: true,
                maxlength: 3
            },
            'test_crudbundle_user[email]':{
                required: true,
                email:true,
                maxlength:30
            },
            'test_crudbundle_user[password][password]':{
                required: true,
                minlength: 6,
                maxlength: 4096
            },
            'test_crudbundle_user[password][confirm]':{
                equalTo: '#test_crudbundle_user_password_password'
            }
        }
    });

    $('.add_userAddress_link').on('click', function(){

    })


});