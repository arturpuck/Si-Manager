<template>
  <div class="expect-circles-outer-container">
    <div v-if="label" v-text="label" class="expect-circles-label"></div>
    <div class="expect-circles-inner-container">
      <div class="flickering-circle flickering-circle-1"></div>
      <div class="flickering-circle flickering-circle-2"></div>
      <div class="flickering-circle flickering-circle-3"></div>
      <div class="flickering-circle flickering-circle-4"></div>
      <div class="flickering-circle flickering-circle-5"></div>
      <div class="flickering-circle flickering-circle-6"></div>
      <div class="flickering-circle flickering-circle-7"></div>
      <div class="flickering-circle flickering-circle-8"></div>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";

@Options({ name: "ExpectCircle" })
export default class ExpectCircle extends Vue {
  @Prop({
    type: String,
    required: false,
    default: "",
  })
  readonly label: string;
}
</script>

<style lang="scss">
@import "~sass/fonts";

.expect-circles-outer-container {
  display: inline-block;
}

.expect-circles-label {
  padding: 4px 0;
  text-align: center;
  @include responsive-font();
  color: white;
}

.expect-circles-inner-container {
  min-width: 100px;
  min-height: 100px;
  width: 50%;
  height: auto;
  position: relative;
  margin: 0 auto;
}

.flickering-circle {
  border-radius: 50%;
  width: 20%;
  height: 20%;
  background: #0b5a8a;
  position: absolute;
  opacity: 0;
  animation: flicker 4s linear 0s infinite;
}

.flickering-circle-1 {
  top: 5%;
  left: 40%;
}

.flickering-circle-2 {
  top: 15%;
  right: 15%;
  animation-delay: 0.5s;
}

.flickering-circle-3 {
  top: 40%;
  right: 5%;
  animation-delay: 1s;
}

.flickering-circle-4 {
  bottom: 15%;
  right: 15%;
  animation-delay: 1.5s;
}

.flickering-circle-5 {
  bottom: 5%;
  left: 40%;
  animation-delay: 2s;
}

.flickering-circle-6 {
  left: 15%;
  bottom: 15%;
  animation-delay: 2.5s;
}

.flickering-circle-7 {
  left: 5%;
  top: 40%;
  animation-delay: 3s;
}

.flickering-circle-8 {
  top: 15%;
  left: 15%;
  animation-delay: 3.5s;
}

@keyframes flicker {
  0% {
    opacity: 0;
  }

  50% {
    opacity: 1;
  }

  70% {
    opacity: 0;
  }

  100% {
    opacity: 0;
  }
}
</style>
