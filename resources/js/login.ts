import { createApp } from 'vue';
import LoginForm from "@jscomponents/login_form.vue";

const settings = {

    components : {
        LoginForm
    },
  
    data() {
       return {
  
       };
    },
  
    methods: {
  
    }
  
  };
//@ts-ignore
const app = createApp(settings);      
app.mount("#app");