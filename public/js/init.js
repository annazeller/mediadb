$( document ).ready(function() {
    const   card = $('.card'),
            login = $('#login'),
            loginForm = $('#loginForm'),
            registerForm = $('#registerForm'),
            register = $('#register');

    card.hide();
    login.click(function(){
        registerForm.hide();
        loginForm.show();
    });

    register.click(function(){
        loginForm.hide();
        registerForm.show();
    });
});