<template>
  <div v-bind:class="{ 'hidden-expect-bar': hide }" class="expect-bar-container">
    <div v-if="label" v-text="label" class="expect-bar-label"></div>
    <div class="expect-bar">
      <div class="square square-1"></div>
      <div class="square square-2"></div>
      <div class="square square-3"></div>
      <div class="square square-4"></div>
      <div class="square square-5"></div>
      <div class="square square-6"></div>
      <div class="square square-7"></div>
      <div class="square square-8"></div>
      <div class="square square-9"></div>
      <div class="square square-10"></div>
      <div class="square square-11"></div>
      <div class="square square-12"></div>
      <div class="square square-13"></div>
      <div class="square square-14"></div>
      <div class="square square-15"></div>
      <div class="square square-16"></div>
      <div class="square square-17"></div>
      <div class="square square-18"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "expect-bar",
  data() {
    return {
      hide: true,
    };
  },

  props: {
    label: {
      required: false,
      type: String,
      default: null,
    },

    hidden: {
      required: false,
      type: Boolean,
      default: true,
    },
  },

  created() {
    this.hide = this.hidden;
  },

  methods: {
    showBar() {
      this.hide = false;
    },
  },
};
</script>

<style lang="scss">
@import "~sass/fonts";

.expect-bar {
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-evenly;
  background: black;
  align-items: center;
  border: 1px solid #066106;
  border-radius: 6px;
  min-height: 25px;
  height: 1vw;
}

.hidden-expect-bar {
  visibility: hidden;
}

.expect-bar-label {
  text-align: center;
  color: white;
  padding: 3px 0;
  @include responsive-font(1.4vw, 18px);
}

.expect-bar-container {
  margin: 5px;
  min-width: 200px;
}

.square {
  width: 0.4vw;
  height: 0.4vw;
  background: #2cf005;
  min-height: 4px;
  min-width: 4px;
  border: none;
}

.square-1 {
  animation: growing-square 5.4s 0s infinite;
}

.square-2 {
  animation: growing-square 5.4s 0.3s infinite;
}

.square-3 {
  animation: growing-square 5.4s 0.6s infinite;
}

.square-4 {
  animation: growing-square 5.4s 0.9s infinite;
}

.square-5 {
  animation: growing-square 5.4s 1.2s infinite;
}

.square-6 {
  animation: growing-square 5.4s 1.5s infinite;
}

.square-7 {
  animation: growing-square 5.4s 1.8s infinite;
}

.square-8 {
  animation: growing-square 5.4s 2.1s infinite;
}

.square-9 {
  animation: growing-square 5.4s 2.4s infinite;
}

.square-10 {
  animation: growing-square 5.4s 2.7s infinite;
}

.square-11 {
  animation: growing-square 5.4s 3s infinite;
}

.square-12 {
  animation: growing-square 5.4s 3.3s infinite;
}

.square-13 {
  animation: growing-square 5.4s 3.6s infinite;
}

.square-14 {
  animation: growing-square 5.4s 3.9s infinite;
}

.square-15 {
  animation: growing-square 5.4s 4.2s infinite;
}

.square-16 {
  animation: growing-square 5.4s 4.5s infinite;
}

.square-17 {
  animation: growing-square 5.4s 4.8s infinite;
}

.square-18 {
  animation: growing-square 5.4s 5.1s infinite;
}

@keyframes growing-square {
  0% {
    transform: scale(1);
  }

  10%,
  20% {
    transform: scale(2.2);
  }

  100% {
    transform: scale(1);
  }
}
</style>
