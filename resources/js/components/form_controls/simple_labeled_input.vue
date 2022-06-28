<template>
  <label class="container">
    <span class="container__description"><slot></slot></span>
    <input
      v-bind:disabled="isDisabled"
      v-bind:name="name"
      :required="inputIsRequired"
      v-bind:placeholder="placeholderText"
      class="container__input"
      v-bind:value="modelValue"
      v-on:input="updateModel"
      v-bind:type="inputType"
      v-bind:min="minimumValue"
      v-bind:max="maximumValue"
    />
  </label>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";
import Translator from "@jsmodules/translator.js";

@Options({ name: "SimpleLabeledInput" })
export default class SimpleLabeledInput extends Vue {
  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly isDisabled: boolean;

  @Prop({
    type: String,
    required: false,
    default: "input",
  })
  readonly name: string;

  @Prop({
    type: String,
    required: false,
    default: "",
  })
  readonly placeholderText: string;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly inputIsRequired: boolean;

  @Prop({
    required: false,
    default: "",
  })
  readonly modelValue: string | number;

  @Prop({
    type: String,
    required: false,
    default: "text",
  })
  readonly inputType: string;

  @Prop({
    type: Number,
    required: false,
    default: null,
  })
  readonly minimumValue: number;

  @Prop({
    type: Number,
    required: false,
    default: null,
  })
  readonly maximumValue: number;

  updateModel(event){
     this.$emit("update:modelValue", event.target.value);
  }
}
</script>

<style lang="scss" scoped>
@import "~sass/fonts";

.container {
  display: flex;
  align-items: baseline;
  background: #242229;
  padding: 3px 10px;
  border-radius: 8px;
  color: white;
  width: 95%;
  border: 2px solid transparent;
  position: relative;
  height: 2em;
}

.container__description {
  white-space: nowrap;
}

.container__input {
  background: #242229;
  border: none;
  border-bottom: 1px solid transparent;
  color: #fff;
  width: 1%;
  flex-grow: 10;
  padding-left: 4px;
  box-shadow: 0 0 0 1000px #242229 inset;
}

.container__input,
.container__description,
.container {
  @include responsive-font;
}

.container__input:focus {
  outline: none;
  border-bottom: 1px solid #86838f;
}
</style>
