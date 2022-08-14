import Translator from '@jsmodules/translator.js';

const translations : {
    loginFormCaption : string,
    loginDataCaption : string,
    password : string,
    rememberMe : string,
    logIn : string,
    iForgotPassword : string
   
} = {
    loginFormCaption : Translator.translate('login_to_sex_empire_manager'),
    loginDataCaption : Translator.translate('email'),
    password : Translator.translate('password'),
    rememberMe : Translator.translate('remember_me'),
    logIn : Translator.translate('log_in'),
    iForgotPassword : Translator.translate('i_forgot_password')
}

export default translations;