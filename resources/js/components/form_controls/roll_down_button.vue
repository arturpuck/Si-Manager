<template>
  <button class="roll-down-button" type="button">
    <span v-text="caption" class="roll-down-button__caption"></span>
    <arrow-down-icon class="roll-down-button__icon"></arrow-down-icon>
  </button>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";
import ArrowDownIcon from "@svgicon/arrow_down_icon";

@Options({ name: "RollDownButton", components: { ArrowDownIcon } })
export default class RollDownButton extends Vue {
  @Prop({
    type: String,
    required: false,
    default: "",
  })
  readonly caption: string;
}
</script>

<style lang="scss">
@import "~sass/fonts";

.roll-down-button {
  background: black;
  cursor: pointer;
  padding: 4px 2px;
  text-align: center;
  width: min-content;

  &__caption {
    display: block;
    color: white;
    padding-bottom: 4px;
    @include responsive-font(1.1vw, 12px);
  }

  &__icon {
    fill: white;
    display: block;
    width: 1em;
    height: auto;
    margin: 0 auto;
  }
}
</style>
