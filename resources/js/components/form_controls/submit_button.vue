<template>
   <button type="submit" class="submit-button">
       <slot></slot>
   </button>
</template>

<script>
	export default {
        name: 'submit-button'
    }
</script>

<style lang="scss">

@import '~sass/fonts';

.submit-button
{
	background: linear-gradient(#0fe00b, #054004);
	padding:5px;
	color:white;
	display:block;
	width:95%;
	margin:7px auto;
	border-radius: 5px;
    font-weight:bold;
    text-align: center;
    border: none;
    cursor:pointer;
    &:hover{
        background:#ef0244;
    }
    @include responsive-font(1.5vw, 19px);
}
</style>