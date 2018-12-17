$( document ).ready(function() {
    const   login = $('#login'),
            loginForm = $('#loginForm'),
            registerForm = $('#registerForm'),
            register = $('#register');

    register.hide();
    login.click(function(){
        registerForm.hide();
        loginForm.show();
    });

    register.click(function(){
        loginForm.hide();
        registerForm.show();
    });
});