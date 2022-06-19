<template>
  <div ref="icon" class="icon-polish-flag"></div>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";

@Options({ name: "IconPolishFlag" })
export default class IconPolishFlag extends Vue {
  @Prop({
    type: String,
    required: false,
    default: "",
  })
  readonly title: string;

  mounted() {
    if (this.title) {
      (<HTMLElement>this.$refs.icon).setAttribute("title", this.title);
    }
  }
}
</script>

<style lang="scss">
.icon-polish-flag {
  width: 2rem;
  height: 1rem;
  z-index: 0;
  display: inline-block;
  background: linear-gradient(to bottom, white 0%, white 50%, red 50%, red 100%);
}
</style>
