<template>
  <div aria-hidden="true" class="icon-play-container">
    <div class="icon-play-triangle"></div>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";

@Component
export default class IconPlay extends Vue {}
</script>

<style lang="scss" scoped>
.icon-play-container {
  display: inline-flex;
  border-radius: 50%;
  background: #df1c4d;
  align-items: center;
  justify-content: center;
  min-width: 15px;
  min-height: 15px;
}

.icon-play-triangle {
  background: white;
  width: 63%;
  height: 63%;
  clip-path: polygon(21% 7%, 21% 92%, 90% 53%);
}
</style>
