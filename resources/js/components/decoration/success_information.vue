<template>
<div v-bind:class="{'hidden-success-information' : !visibleNotification, 'no-dimension' : noDimension}" class="success-information">
    <div class="confirmation-text">
        <slot></slot>
    </div>
    <div class="icon-background">
        <icon-confirm v-on:click="hideNotification" v-bind:aditional-classes="{container : 'icon-confirmation-center'}"></icon-confirm>
    </div>   
</div>
</template>

<script>
import IconConfirm from "@jscomponents/decoration/icon_confirm.vue";

	export default {
        name: 'success-information',
        components : {
            IconConfirm
        },

        data(){
            return {
                visibleNotification : true,
                noDimension : false
            }
        },

        methods : {
            hideNotification(){
               this.visibleNotification = false;
               setTimeout(() => this.noDimension = true, 1200);
            }
        }
    }
</script>

<style lang="scss" scoped>

.success-information{
	margin: calc(30px + 3vw) auto;
    text-align: center;
    font-family: 'Exo 2', sans-serif;
    border-radius: 6px;
    color: white;
    position:relative;
    box-shadow: 2px 2px 3px 2px black;
    overflow: hidden;
    display: block;
    min-width: 250px;
    width: 15vw;
    max-height: 10000px;
    opacity:1;
    transition: max-height 1.5s, opacity 1.5s;
}

.no-dimension{
    max-height: 0;
}

.hidden-success-information{
    opacity:0;
}

.icon-background{
    background: rgba(0,0,0,0.9);
    padding: 7px;
}

.icon-confirmation-center{
    display: block;
    margin:0 auto;
    width:3vw;
    height:3vw;
    min-width: 35px;
    min-height: 35px;
    cursor:pointer;
}

.confirmation-text{
    text-align: center;
    padding: 10px;
    background:linear-gradient(#16d012, #021502);
}

</style>