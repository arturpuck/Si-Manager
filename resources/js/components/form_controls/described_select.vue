<template>
  <div class="described-select-container">
    <div
      v-if="errorMessageBoxAvailable"
      v-text="errorMessage"
      class="error-message-box"
    ></div>
    <label
      class="select-label"
      v-bind:class="{
        'incorrect-value': displayRedBorder,
        'correct-value': displayGreenBorder,
      }"
    >
      <icon-stop
        v-bind:attached-icon="true"
        v-if="iconErrorCanBeDisplayed"
        v-show="displayIconError"
      />
      <icon-confirm
        v-bind:attached-icon="true"
        v-if="iconConfirmationCanBeDisplayed"
        v-show="displayIconConfirmation"
      />
      <span class="select-description"><slot></slot></span>
      <select
        v-bind:name="name"
        ref="select_value"
        v-model="inputValue"
        v-on:change="valueHasBeenSelected"
        class="described-select"
      >
        <option
          v-bind:key="index"
          v-for="(option, index) in visibleOptionsList"
          v-bind:value="optionsValuesInternal[index]"
        >
          {{ option }}
        </option>
      </select>
    </label>
  </div>
</template>

<script lang="ts">
import IconStop from "@jscomponents-decoration/icon_stop.vue";
import IconConfirm from "@jscomponents-decoration/icon_confirm.vue";
import ComboInputBasicFunctionality from "@mixins/components/comboInputs/comboInputBasicFunctionality";

export default {
  emits: ["selected"],
  name: "described-select",
  mixins: [ComboInputBasicFunctionality],

  components: {
    IconStop,
    IconConfirm,
  },

  props: {
    uniqueId: {
      required: false,
      type: String,
      default: "",
    },

    visibleOptionsList: {
      required: true,
      type: Array,
    },

    optionValues: {
      required: false,
      type: Array,
      default: undefined,
    },

    name: {
      required: false,
      type: String,
      default: "described_select",
    },

    initialValue: {
      required: false,
      type: String,
      default: "not-selected",
    },

    errorIconAvailable: {
      required: false,
      type: Boolean,
      default: false,
    },

    confirmationIconAvailable: {
      required: false,
      type: Boolean,
      default: false,
    },

    redBorderAvailable: {
      required: false,
      type: Boolean,
      default: false,
    },

    greenBorderAvailable: {
      required: false,
      type: Boolean,
      default: false,
    },

    initialOk: {
      required: false,
      type: Boolean,
      default: undefined,
    },

    completeErrorDisplayAvailable: {
      required: false,
      type: Boolean,
      default: false,
    },

    completeConfirmationDisplayAvailable: {
      required: false,
      type: Boolean,
      default: false,
    },

    completeValidationDisplayAvailable: {
      required: false,
      type: Boolean,
      default: false,
    },

    errorMessageBoxAvailable: {
      required: false,
      type: Boolean,
      default: false,
    },

    initialErrorText: {
      required: false,
      type: String,
      default: undefined,
    },
  },

  data() {
    return {
      valueOK: undefined,
      errorMessage: undefined,
      inputValue: undefined,
      iconErrorCanBeDisplayed: undefined,
      iconConfirmationCanBeDisplayed: undefined,
      redBorderCanBeDisplayed: undefined,
      greenBorderCanBeDisplayed: undefined,
      optionsValuesInternal: undefined,
    };
  },

  computed: {
    displayIconError() {
      return this.iconErrorCanBeDisplayed && this.valueOK === false;
    },

    displayRedBorder() {
      return this.redBorderCanBeDisplayed && this.valueOK === false;
    },

    displayIconConfirmation() {
      return this.iconConfirmationCanBeDisplayed && this.valueOK === true;
    },

    displayGreenBorder() {
      return this.greenBorderCanBeDisplayed && this.valueOK === true;
    },
  },

  created() {
    this.initiateSettings();
    this.attachEventListeners();
  },

  methods: {
    initiateSettings(): void {
      this.inputValue = this.initialValue;
      this.errorMessage = this.initialErrorText;
      this.iconErrorCanBeDisplayed =
        this.errorIconAvailable ||
        this.completeErrorDisplayAvailable ||
        this.completeValidationDisplayAvailable;

      this.iconConfirmationCanBeDisplayed =
        this.confirmationIconAvailable ||
        this.completeConfirmationDisplayAvailable ||
        this.completeValidationDisplayAvailable;

      this.redBorderCanBeDisplayed =
        this.redBorderAvailable ||
        this.completeErrorDisplayAvailable ||
        this.completeValidationDisplayAvailable;

      this.greenBorderCanBeDisplayed =
        this.greenBorderAvailable ||
        this.completeConfirmationDisplayAvailable ||
        this.completeValidationDisplayAvailable;

      this.optionsValuesInternal =
        this.optionValues === undefined
          ? this.visibleOptionsList
          : this.optionValues;
      this.valueOK = this.initialOk;
    },
    valueHasBeenSelected(): void {
      this.$emit("selected", {value : this.inputValue, uniqueId : this.uniqueId});
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~sass/error_message_box";
@import "~sass/fonts";

.select-label {
  display: flex;
  align-items: baseline;
  border-radius: 7px;
  padding: 3px 10px;
  color: white;
  width: 95%;
  margin: 0 auto;
  background: #242229;
  position: relative;
  border: 2px solid transparent;
  height: 2em;
}

.select-description {
  white-space: nowrap;
}

.described-select {
  width: 1%;
  flex-grow: 10;
  color: white;
  border: none;
  background: #242229;
  outline: none;
}

.described-select,
.select-description,
.select-label {
  @include responsive-font;
}

.incorrect-value {
  border: 2px solid red;
}

.correct-value {
  border: 2px solid green;
}
</style>