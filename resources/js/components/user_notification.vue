<template>
  <div
    v-bind:class="{
      'visible-user-notification-container': visible,
      'flickering-background': flicker,
    }"
    class="user-notification-container"
  >
    <header
      v-bind:class="{
        'no-error-notification-bar': !showsError,
        'error-notification-bar': showsError,
      }"
      class="notification-bar"
    >
      <h1 v-text="headerText" class="notification-header"></h1>
      <button-close v-on:click="closeNotification"></button-close>
    </header>
    <p v-text="notificationText" class="notification-content"></p>
    <div class="notification-pseudo-footer">
      <component v-bind:class="decorationComponentClass" v-bind:is="decorationComponentName"></component>
    </div>
  </div>
</template>

<script lang="ts">
import ButtonClose from "@jscomponents/form_controls/button_close.vue";
import { Vue, Options } from "vue-property-decorator";
import Translator from '@jsmodules/translator.js';
import InfoCircleIcon from "@svgicon/info_circle_icon.vue";
import ExclamationErrorIcon from "@svgicon/exclamation_icon.vue";


@Options({ name: "UserNotification", components: { ButtonClose, InfoCircleIcon, ExclamationErrorIcon } })
export default class UserNotification extends Vue {
  private notificationText: string = "";
  private visible: boolean = false;
  private headerText: string = "Information";
  private type: string = "no-error";
  private flicker: boolean = false;

  closeNotification() {
    this.visible = false;
  }

  showNotification(content) {
    const currentType = this.type;
    const currentNotificationText = this.notificationText;
    const translator = Translator;

    if (content["headerText"]) {
      this.headerText = translator.translate(content["headerText"]);
    }

    if (content["notificationText"]) {
      this.notificationText = translator.translate(content["notificationText"]);
    }

    if (content["notificationType"]) {
      this.type = content["notificationType"];
    }
    
    if (
      this.visible &&
      this.type === currentType &&
      this.notificationText === currentNotificationText
    ) {
      this.flicker = true;
      setTimeout(() => (this.flicker = false), 1000);
    }
    this.visible = true;
  }

  get showsError() {
    return this.type === "error";
  }

  get decorationComponentName() : string
  {
    return this.showsError ? 'exclamation-error-icon' : 'info-circle-icon';
  }

  get decorationComponentClass() : string
  {
     return this.showsError ? 'decoration-component--error' : 'decoration-component--info';
  }

  mounted() {
    //@ts-ignore
    this.emitter.on("showNotification", this.showNotification);
  }
}
</script>

<style lang="scss" scoped>
@import "~sass/fonts";
@import "~sass/responsive_icon";

@mixin decoration-icon{
   width: 1.5em;
   height: auto;
}

.decoration-component{
    &--error{
      @include decoration-icon();
      fill:rgba(255, 0, 0, 0.877);
    }

    &--info{
      @include decoration-icon();
      fill:#32880a;
    }
}

.notification-pseudo-footer {
  padding: 2px;
  text-align: center;
}

.icon-information {
  color: green;
}

.icon-information,
.icon-error {
  @include responsive-font(1.5vw, 21px, "");
}

.user-notification-container {
  position: fixed;
  z-index: 5;
  right: 1%;
  bottom: 0;
  transform: translateY(100%);
  transition: transform 1.5s;
  width: 20%;
  min-width: 250px;
  overflow: hidden;
  border-radius: 8px 8px 0 0;
  box-shadow: 2px 2px 2px 2px black;
  background: #b1b1ca;
  color: black;
}

.visible-user-notification-container {
  transform: translateY(0);
}

.notification-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 8px;
  line-height: 2.2em;
  @include responsive-font();
}

.no-error-notification-bar {
  background: linear-gradient(#0fe00b, #054004);
  color: white;
}

.error-notification-bar {
  background: #ca1a1a;
  color: black;
}

.notification-header {
  @include responsive-font(1.4vw, 21px);
  margin: 0;
  padding: 0;
}

.notification-content {
  margin: 0;
  padding: 4px;
  @include responsive-font(1.2vw, 15px);
}

.flickering-background {
  background: #ca1a1a;
  color: white;
}

.icon-error {
  color: #ca1a1a;
}
</style>