import NotificationType from "@js/enums/notification_type";

export default interface UserNotificationBox {
   type? : NotificationType,
   message : string,
   headerText : string
}