<template>
<div ref="container" class="icon-error-cross-container">
    <div class="icon-error-close"></div>
</div>
</template>

<script>
	export default {
        name: 'icon-error-close',

        props : {
            aditionalClasses : {
                required : false,
                type : Object,
                default : undefined 
             }
        },

         mounted(){
            if(this.aditionalClasses){
                Object.keys(this.aditionalClasses).forEach((key) => this.$refs[key].classList.add(this.aditionalClasses[key]));
            }
        }
    }
</script>

<style lang="scss">
@import '~sasscomponent/icons/icon_error_cross';
</style>