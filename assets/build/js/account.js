/**
 * Author : s4Lv4t0r3
 * Date   : January 13, 2019
 */

var AccountModel = (function(){

    class User {
        constructor(email, password, repass) {
            this.email = email;
            this.password = password;
            this.re_pass = repass;
        }
    }

    class Company {
        constructor(email, password, sub_type) {
            this.email = email;
            this.password = password;
            this.sub_type = sub_type;
        }
    }
    
    let user    = {};
    let company = {};

    /**
     * Function to validate company details
     * from the signup section of the system
     * @param {string} email 
     * @param {string} password 
     * @param {string} repass 
     * @param {number} sub_type 
     */
    function validateCompanySignUp(email, password, repass, sub_type) {
        let counter = 0;
        let numbers = new RegExp("^[0-9]+$"); 
        if(email === ''){
            new PNotify({
                title: 'Error!',
                text: 'Email field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        }

        if(password === '' || repass === ''){
            new PNotify({
                title: 'Error!',
                text: 'Passwords field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            
            counter++;
        } else if(password !== repass){
            new PNotify({
                title: 'Error!',
                text: 'Password does not match',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            counter++;
        }

        // if(sub_type === '0' || sub_type === ''){
        //     new PNotify({
        //         title: 'Error!',
        //         text: 'Internal Error Occured! You\'ve done something wrong',
        //         styling: 'bootstrap3',
        //         type: 'error',
        //         hide: 'false'
        //     });
            
        //     counter++;
        // } else if(!sub_type.match(numbers)){
        //     new PNotify({
        //         title: 'Error!',
        //         text: 'Internal Error Occured! You\'ve done something wrong',
        //         styling: 'bootstrap3',
        //         type: 'error',
        //         hide: 'false'
        //     });
            
        //     counter++;
        // }
        return counter;
    };

    /**
     * Validate Applicant Signup
     * @param {string} email 
     * @param {string} password 
     * @param {string} repass 
     */
    function validateSignUp(email, password, repass){
        let counter = 0;
        
        if(email === ''){
            new PNotify({
                title: 'Error!',
                text: 'Email field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            counter++;
        }

        if(password === '' || repass === ''){
            new PNotify({
                title: 'Error!',
                text: 'Passwords field should not be left blank!',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            counter++;
        } else if(password !== repass){
            new PNotify({
                title: 'Error!',
                text: 'Password does not match',
                styling: 'bootstrap3',
                type: 'error',
                hide: 'false'
            });
            counter++;
        }

        return counter;
    }

    return {
        /**
         * Function to set user data into the JS VM
         * which takes 3 arguments
         * @param {string} email
         * @param {string} password
         * @param {string} repass
         */
        setUserData: (email, password, repass) => {
           
            let error_counter = validateSignUp(email, password, repass);
            if(error_counter === 0){
                user = new User(email, password, repass);
                return error_counter;
            }

            return error_counter;
        },

        /**
         * Get user data stored in JS VM
         */
        getUserData: () => {
            return user;
        },

        /**
         * Function to load company information into
         * the JS VM memory which takes 4 arguments.
         * This Method also validate company data
         * before loading the data in the memory
         * @param {string} email
         * @param {string} password
         * @param {string} repass
         * @param {number} type
         */
        setCompanyData: (email, password, repass, type) => {
            let error_counter = validateCompanySignUp(email, password, repass, type);
            if(error_counter === 0){
                company = new Company(email, password, type);
                return error_counter;
            }
            return error_counter;
        },

        getCompanyData: () => {
            return company;
        },

        /**
         * Public Method that validate user data
         * during login process
         * @param {string} email
         * @param {password} password
         */
        validateLogin: (email, password) => {
            let counter     = 0;
            let email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(email === ''){
                new PNotify({
                    title: 'Error!',
                    text: 'Email field should not be left blank!',
                    styling: 'bootstrap3',
                    type: 'error',
                    hide: 'false'
                });
                
                counter++;
            } else if(!email.match(email_regex)){
                new PNotify({
                    title: 'Error!',
                    text: 'Invalid Email Address!',
                    styling: 'bootstrap3',
                    type: 'error',
                    hide: 'false'
                });
                
                counter++;
            }
            if(password === ''){
                new PNotify({
                    title: 'Error!',
                    text: 'Password field should not be left blank!',
                    styling: 'bootstrap3',
                    type: 'error',
                    hide: 'false'
                });
                
                counter++;
            } else if(password.length < 8){
                new PNotify({
                    title: 'Error!',
                    text: 'Password field should be atleast 8 characters long!',
                    styling: 'bootstrap3',
                    type: 'error',
                    hide: 'false'
                });
                
                counter++;
            }
            return counter;
        }
    };

})();

/**
 * Account View Module
 */
var AccountView = (function(){
    
    const DOMStrings = {
        //Sign Up
        input_username          : 'input#email',
        input_password          : 'input#password',
        input_re_password       : 'input#re-password',
        register_btn            : 'button#register-client',

        //Company Sign Up
        company_username        : 'input#company_email',
        company_password        : 'input#company_password',
        company_re_password     : 'input#company_re-password',
        cregister_btn           : 'button#register-company',

        //Login
        login_username          : 'input#login-name',
        login_password          : 'input#login-pass',
        login_btn               : 'button#login-btn',

        //Company Login
        clogin_username         : 'input#company-login-name',
        clogin_password         : 'input#company-login-pass',
        clogin_btn              : 'button#company-login-btn',

        //Subscription Button
        btn_subs                : 'button#process-subscription'
    };

    return {     
        getDOMStrings: () => {
            return DOMStrings;
        },
    };

})();

var AccountController = (function(accountModel, accountView){
    
    let DOM = accountView.getDOMStrings();

    /**
     * Set Up Event Listeners 
     * for the Account Model
     */
    let setUpEventListeners = () => {
        
        let register_client = $(DOM.register_btn).on('click', register);

        let login_client    = $(DOM.login_btn).on('click', login);

        let subs            = $(DOM.btn_subs).on('click', subscribe);

        let cregister       = $(DOM.cregister_btn).on('click', registerCompany);

        let clog            = $(DOM.clogin_btn).on('click', loginCompany);

        if($('button#paypal-button').length){
            paypal.Button.render({
                env: 'sandbox',
                client: {
                    sandbox: 'AWBxbRLPD6mhxNWay91PJIZJHPM_ClkU6MLrt1TnsVhr8UvJhyQTL_5XwSXDU0uJYEEY1uePpqt5g96Y'
                },
                style: {
                    color: 'gold',   // 'gold, 'blue', 'silver', 'black'
                    size:  'medium', // 'medium', 'small', 'large', 'responsive'
                    shape: 'rect'    // 'rect', 'pill'
                },
                payment: function (data, actions) {
                    return actions.payment.create({
                        transactions: [{
                            amount: {
                                total: window.sessionStorage.getItem('price'),
                                currency: 'USD'
                            }
                        }]
                    });
                },
                onAuthorize: function (data, actions) {
                    return actions.payment.execute()
                        .then(function () {
                            registerCompany();
                        });
                }
            }, '#paypal-button');
        }

        if($('button#process-subscription-1').length){

            ['button#process-subscription-1', 'button#process-subscription-2', 'button#process-subscription-3' ].forEach(function(selector){
                paypal.Button.render({
                    env: 'sandbox',
                    client: {
                        sandbox: 'AWBxbRLPD6mhxNWay91PJIZJHPM_ClkU6MLrt1TnsVhr8UvJhyQTL_5XwSXDU0uJYEEY1uePpqt5g96Y'
                    },
                    style: {
                        color: 'gold',   // 'gold, 'blue', 'silver', 'black'
                        size:  'medium', // 'medium', 'small', 'large', 'responsive'
                        shape: 'rect',    // 'rect', 'pill'
                        label: 'pay'
                    },
                    payment: function (data, actions) {
                        return actions.payment.create({
                            transactions: [{
                                amount: {
                                    // total: window.sessionStorage.getItem('price'),
                                    total: $(selector).data('rate-price'),
                                    currency: 'USD'
                                }
                            }]
                        });
                    },
                    onAuthorize: function (data, actions) {
                        return actions.payment.execute()
                            .then(function () {
                                subscribe(selector);
                                // alert($(selector).data('rate-price'));
                            });
                    }
                }, selector);
            });
        }

    };

    /**
     * Applicant Register Method
     */
    function register(e){
        e.preventDefault();
        let email   = $(DOM.input_username).val();
        let pass    = $(DOM.input_password).val();
        let re_pass = $(DOM.input_re_password).val();

        accountModel.setUserData(email, pass, re_pass);

        let user    = accountModel.getUserData();

        $.ajax({
            url: DESTINATION + 'home/record_user',
            type: 'POST',
            data: user,
            success: (response) => {
                var result = JSON.parse(response);
                if(result.key === 'error'){
                    new PNotify({
                        title: 'An Error Occured!',
                        text: result.message,
                        type: 'error',
                        styling: 'bootstrap3',
                        hidden: false
                    });
                } else if(result.key === 'success'){
                    window.location.href = DESTINATION + 'home';
                }
            }
        });
    };

    /**
     * Applicant Login Method
     */
    function login(e){
        e.preventDefault();
        
        $email = $(DOM.login_username).val();
        $pass  = $(DOM.login_password).val();

        let status = accountModel.validateLogin($email, $pass);
        if(status === 0) {
            $.ajax({
                url: DESTINATION + 'home/login_account',
                type: 'POST',
                data: {
                    'email' : $email,
                    'pass'  : $pass
                },
                success: (response) => {
                    let result = JSON.parse(response);
                    if(result === true){
                        window.location.href = DESTINATION + 'client';
                    } else if (result.key === 'error'){
                        new PNotify({
                            title: 'An Error Occured!',
                            text: result.message,
                            type: 'error',
                            styling: 'bootstrap3',
                            hidden: false
                        });
                    }
                }
            });
        }
    };

    /**
     * Company Login Method
     */
    function loginCompany(e){
        e.preventDefault();

        let email   = $(DOM.clogin_username).val();
        let pass    = $(DOM.clogin_password).val();

        let error = accountModel.validateLogin(email, pass);
        //TODO:
        if(error === 0){
            $.ajax({
                url: DESTINATION + 'company/company_login',
                type: 'POST',
                data: {
                    email: email,
                    password: pass
                },
                success: (response) => {
                    console.log(response);
                    let result = JSON.parse(response);
                    
                    if(result.key === 'error'){
                        new PNotify({
                            title: 'An Error Occured!',
                            text: result.message,
                            type: 'error',
                            styling: 'bootstrap3',
                            hidden: false
                        });
                    } else {
                        window.location.href = DESTINATION + 'company';
                    }
                }
            });
        }
    }

    /**
     * Subscribe Method
     */
    function subscribe(){
        let id    = $(this).data('rate-type');
        let price = $(this).data('rate-price');
        sessionStorage.setItem("subscription", id);
        sessionStorage.setItem("price", price);
        window.location.href = DESTINATION + 'home/company_signup';
    };

    /**
     * Subscribe Method with Selector as 
     * a Parameter
     * @param {string} selector
     */
    function subscribe(selecttor){
        let id    = $(selecttor).data('rate-type');
        let price = $(selecttor).data('rate-price');
        sessionStorage.setItem("subscription", id);
        sessionStorage.setItem("price", price);
        window.location.href = DESTINATION + 'home/company_signup';
    }

    /**
     * Register Company Details
     */
    function registerCompany(e){
        e.preventDefault();
        let company_email       = $(DOM.company_username).val();
        let company_password    = $(DOM.company_password).val();
        let company_re_password = $(DOM.company_re_password).val();
        // let subscription_type   = sessionStorage.getItem("subscription");
        let subscription_type   = null;
        let errors = accountModel.setCompanyData(company_email, company_password, company_re_password, subscription_type);

        if(errors === 0){
            let company = accountModel.getCompanyData(); 
            $.ajax({
                url: DESTINATION + 'home/store_company',
                type: 'POST',
                data:company,
                success: (response) =>{
                    let result = JSON.parse(response);
                    if(result.key === "error") {
                        new PNotify({
                            title: 'An Error Occured!',
                            text: result.message,
                            type: 'error',
                            styling: 'bootstrap3',
                            hidden: false
                        });
                    } else if(result === true){
                        console.log(response);
                        window.location.href = DESTINATION + 'home/confirm';
                    }
                }
            });
        } else {
            $(DOM.company_password).val("");
            $(DOM.company_re_password).val("");
        }
    }

    return {
        init: () => {
            setUpEventListeners();
            console.log("Service Started..");
        }
    }
})(AccountModel, AccountView);

AccountController.init();