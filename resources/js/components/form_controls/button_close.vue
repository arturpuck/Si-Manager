<template>
  <button
    type="button"
    class="button-close"
  >
    <svg
      class="button-close__cross"
      id="Layer_1"
      data-name="Layer 1"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 122.88 122.88"
    >
      <path
        class="cls-1"
        d="M6,6H6a20.53,20.53,0,0,1,29,0l26.5,26.49L87.93,6a20.54,20.54,0,0,1,29,0h0a20.53,20.53,0,0,1,0,29L90.41,61.44,116.9,87.93a20.54,20.54,0,0,1,0,29h0a20.54,20.54,0,0,1-29,0L61.44,90.41,35,116.9a20.54,20.54,0,0,1-29,0H6a20.54,20.54,0,0,1,0-29L32.47,61.44,6,34.94A20.53,20.53,0,0,1,6,6Z"
      />
    </svg>
    <span v-text="label" class="button-close__label"></span>
  </button>
</template>

<script lang="ts">
import { Vue, Options } from "vue-property-decorator";
import Translator from '@jsmodules/translator.js';

@Options({ name: "ButtonClose", inheritAttrs: true })
export default class ButtonClose extends Vue {
  public label = Translator.translate('close');
}
</script>

<style lang="scss" scoped>
.button-close:hover .button-close__cross {
  background: white;
}

.cls-1 {
  fill: #ef0244;
  fill-rule: evenodd;
}

.button-close {
  position: relative;
  flex-shrink: 0;
  background: white;
  border-radius: 50%;
  border: 3px solid #ef0244;
  font-size: 0;
  min-width: 30px;
  min-height: 30px;
  width: 2.3vw;
  height: 2.3vw;
  cursor: pointer;
  display: inline-block;
  &:hover {
    background: #ef0244;
  }

  &__cross {
    display: inline-block;
    width: 65%;
    height: 65%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  &__label {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
}

.button-close:hover .cls-1{
    fill:white;
    fill-rule: evenodd;
}

.button-close:hover .button-close__cross{
  background: #ef0244;
}
</style>
