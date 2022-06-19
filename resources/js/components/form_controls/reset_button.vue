<template>
  <button type="reset" class="reset-button">
    <slot></slot>
  </button>
</template>

<script lang="ts">
import { Vue, Options } from "vue-property-decorator";

@Options({ name: "ResetButton" })
export default class ResetButton extends Vue {}
</script>

<style lang="scss" scoped>
@import "~sass/fonts";

.reset-button {
  background: linear-gradient(#ec1515, #8a240a);
  padding: 5px;
  color: white;
  display: block;
  width: 95%;
  margin: 7px auto;
  border-radius: 5px;
  font-weight: bold;
  border: none;
  cursor: pointer;
  &:hover {
    background: #ef0244;
  }
  @include responsive-font(1.5vw, 19px);
}
</style>
