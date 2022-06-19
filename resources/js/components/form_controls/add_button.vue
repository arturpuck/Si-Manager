<template>
 <button v-on:click="send" class="add-button">
    <span v-text="Translator.translate('add_comment_short')"></span>
    <add-plus-icon class="add-comment-decoration"></add-plus-icon>
</button> 
</template>

<script lang="ts">
import AddPlusIcon from "@svgicon/add_plus_icon.vue";
import Translator from "@jsmodules/translator.js";

export default {
    name : "add-button",

    data() {
        return { 
          Translator
        }
    },
    

    components : {
        AddPlusIcon
    }

}
</script>

<style lang="scss">
@import "~sass/fonts";
@import "~sass/responsive_icon";

.add-button {
  background: linear-gradient(#11ea11, #205a07);
  border-radius: 0.7vw;
  border: none;
  display: flex;
  align-items: center;
  flex-wrap: nowrap;
  margin: 0 5px;
  padding: 0.3vw;
  color: white;
  outline: none;
  @include responsive-font();
  cursor: pointer;
  &:active {
    transform: scale(1.05);
  }
  &:hover {
    background: linear-gradient(#da3232, #3e0606);
  }
}

.add-comment-decoration {
  margin: 0 4px;
  width: 1em;
  height: auto;
  fill: white;
}

</style>