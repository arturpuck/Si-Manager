<template>
  <button type="button" class="accept-button">
    <slot></slot>
  </button>
</template>

<script lang="ts">
import { Vue, Options } from "vue-property-decorator";

Options({ name: "AcceptButton" });
export default class AcceptButton extends Vue {}
</script>

<style lang="scss" scoped>
@import "~sass/fonts";

.accept-button {
  background: linear-gradient(#0fe00b, #054004);
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
