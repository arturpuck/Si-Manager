import Translator from '@jsmodules/translator.js';

const translations : {
    cookieNotificationHeader : string,
    cookieNotificationBody : string,
    acceptButtonCaption : string
} = {
    cookieNotificationHeader : Translator.translate('cookie_notification_header'),
    cookieNotificationBody : Translator.translate('cookie_notification_body'),
    acceptButtonCaption : Translator.translate('accept_button_caption')
}

export default translations;