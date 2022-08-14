<template>
   <div
      class="login-form-container"
    >
      <form
        action="/login"
        method="POST"
        id="login-form"
        class="login-form"
      >
        <header v-text="translations['loginFormCaption']" class="login-panel-toolbar"></header>
        <input v-bind:value="csrfToken" type="hidden" name="_token" />
        <label for="email" v-text="translations['loginDataCaption']" class="main-panel-label"></label>
        <simple-labeled-input
          v-bind:input-is-required="true"
          input-id="email"
          inputType="email"
          name="email"
          class="credentials"
        >
        </simple-labeled-input>
        <label for="password" v-text="translations['password']" class="main-panel-label"></label>
        <simple-labeled-input
          v-bind:input-is-required="true"
          input-id="password"
          inputType="password"
          name="password"
          class="credentials"
        >
        </simple-labeled-input>
        <submit-button>{{translations['logIn']}}</submit-button>
      </form>
    </div>
</template>

<script lang="ts">
  
  import Translations from '@jsmodules/translations/components/login_form';
  import SimpleLabeledInput from '@jscomponents/form_controls/simple_labeled_input.vue';
  import ButtonClose from "@jscomponents/form_controls/button_close.vue";
  import SubmitButton from "@jscomponents/form_controls/submit_button.vue";

  export default {
      name : 'login-form',

      components : {
        SimpleLabeledInput,
        ButtonClose,
        SubmitButton
        },

      emits : ['hide'],

      data()
      {
        return {
          csrfToken : '',
          translations : Translations
        }
      },

      created(){
        this.csrfToken = (<HTMLMetaElement>document.getElementById("csrf-token")).content;
      },

      methods : {
        
      }
  }
  

</script>

<style lang="scss" scoped>
@import "~sasscomponent/login_panel";

.credentials {
  margin:0 auto;
}
  
</style>