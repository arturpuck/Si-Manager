import NotificationType from "@js/enums/notification_type";
import Translator from "@jsmodules/translator.js";
import UserNotificationBox from "@interfaces/components/user_notification_box";


export default {
    methods : {
        showUserNotification(message : string, headerText = "information", showError = false) : void {

            let notificationStatus : UserNotificationBox = {
                message : Translator.translate(message),
                headerText : Translator.translate(headerText),
                type : showError ? NotificationType.Error : NotificationType.Neutral,
            }

            this.emitter.emit('showNotification', notificationStatus);

        }
    }
}