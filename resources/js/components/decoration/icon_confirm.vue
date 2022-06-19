<template>
  <div ref="container" v-bind:class="{'attached-icon' : attachedIcon}" class="icon-container icon-correct-value">
    <div class="confirmation-icon-bird"></div>
  </div>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";
   @Options({name : 'IconConfirm'})
	export default class IconConfirm extends Vue {

        @Prop({
                type: Object,
                required: false,
                default:undefined
        }) readonly aditionalClasses: object;

        @Prop({
                type: Boolean,
                required: false,
                default:false
        }) readonly attachedIcon: boolean;

         mounted(){
            if(this.aditionalClasses){
                Object.keys(this.aditionalClasses).forEach((key) => (<HTMLElement>this.$refs[key]).classList.add(this.aditionalClasses[key]));
            }
        }
    }
</script>

<style lang="scss" scoped>

@import '~sasscomponent/icons/icon_confirmation';

.attached-icon{
    position:absolute;
    top:0;
    right:0;
    transform:translate(50%,-50%);
}

</style>