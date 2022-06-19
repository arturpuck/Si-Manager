<template>
    <label class="labeled-range">
            <span  class="labeled-range__description">
                <slot></slot>
            </span> 
            <input type="range" v-bind:min="min" v-bind:max="max" v-bind:value="modelValue" v-on:input="updateModel" class="labeled-range__value">
            <span v-text="displayedValue"></span> 
         </label>
</template>

<script lang="ts">
export default {

    props : {

        modelValue : {
            required : false,
            type: Number,
            default : undefined,
        },

       min : {
           required : false,
           type : Number,
           default : 0
       },

       max : {
           required : false,
           type : Number,
           default : 100
       },

       unit : {
           required : false,
           type : String,
           default : ""
       }
    },

    methods : {
        updateModel(event) : void {
           this.$emit('update:modelValue', parseInt(event.target.value));
        }
    },

    computed : {
        displayedValue() : string {
            return this.modelValue + ' ' + this.unit;
        }
    }
    
}
</script>
<style lang="scss">
@import "~sass/fonts";

.labeled-range {
    border-radius: 7px;
    padding: 3px 10px;
    color: white;
    background: #242229;
    position: relative;
    border: 2px solid transparent;
    @include responsive-font(1.2vw, 16px);
    height: 2em;
    display:flex;
    align-items:center;

    &__description {
        line-height: 1em;
    }

    &__value {
        flex-grow: 100;
    }
}
    
</style>