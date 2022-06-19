export default function(text:string, type:string = "no-error"){
    const header:string = type === "no-error" ? "information" : "error";
    this.emitter.emit('showNotification', {notificationText : text, notificationType : type, headerText : header});
 }