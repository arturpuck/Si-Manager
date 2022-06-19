<template>
  <div class="icon-add-plus">
    <div class="icon-add-plus__plus"></div>
  </div>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";

@Options({ name: "IconAddPlus" })
export default class IconAddPlus extends Vue {}
</script>

<style lang="scss" scoped>
$size: 2vw;
$min-size: 25px;

.icon-add-plus {
  display: inline-block;
  width: $size;
  height: $size;
  min-width: $min-size;
  min-height: $min-size;
  background: #a52323;
  border-radius: 7px;

  &__plus {
    clip-path: polygon(
      15% 40%,
      40% 40%,
      40% 15%,
      60% 15%,
      60% 40%,
      85% 40%,
      85% 60%,
      60% 60%,
      60% 85%,
      40% 85%,
      40% 60%,
      15% 60%
    );
    background: #e2e0df;
    width: 100%;
    height: 100%;
  }
}

@import "~sass/fonts";
</style>
