<template>
  <div  class="fixed-shadow-container">
    <slot></slot>
  </div>
</template>

<script lang="ts">
	export default {
        name: 'fixed-shadow-container'
    }
</script>

<style lang="scss">

.fixed-shadow-container{
    position:fixed;
    width:100%;
    height:100vh;
    background:rgba(0,0,0,0.7);
    display:flex;
    justify-content: center;
    align-items: center;
    z-index: 6;
    top: 0;
    left: 0;
}

</style>