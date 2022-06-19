<template>
  <div class="text-input-combo-container">
    <div
      v-if="errorMessageBoxAvailable"
      v-text="errorMessage"
      class="error-message-box"
    ></div>
    <label
      ref="label"
      v-bind:class="{
        'incorrect-value': displayRedBorder,
        'correct-value': displayGreenBorder,
      }"
      class="text-input-combo-value-label"
    >
      <padlock-icon
        v-if="isDisabled"
        class="disabled-input-icon"
      ></padlock-icon>
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
      <span class="text-input-description"><slot></slot></span>
      <input
        v-bind:id="inputId"
        v-bind:disabled="isDisabled"
        v-on:blur="emitBlur"
        v-on:input="updateModel"
        v-bind:name="name"
        :required="inputIsRequired"
        v-bind:placeholder="placeholderText"
        class="text-input-combo-value"
        v-model="inputValue"
        v-bind:type="inputType"
      />
    </label>
  </div>
</template>

<script lang="ts">
import PadlockIcon from "@svgicon/padlock_icon.vue";
import IconStop from "@jscomponents-decoration/icon_stop.vue";
import IconConfirm from "@jscomponents-decoration/icon_confirm.vue";
import ComboInputBasicFunctionality from "@mixins/components/comboInputs/comboInputBasicFunctionality";

export default {
  name: "text-input-combo",

  mixins: [ComboInputBasicFunctionality],

  emits: ["blur"],

  components: {
    PadlockIcon,
    IconStop,
    IconConfirm,
  },

  watch : {
    modelValue(){
      this.inputValue = this.modelValue;
    }
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
    emitBlur() {
      this.$emit("blur", this.inputValue);
    },

    updateModel() : void {
      this.$emit('update:modelValue', this.inputValue);
    },

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
      this.valueOK = this.initialOk;
    },
  },

  props: {
    
    modelValue : {
      required: false,
      default : null
    },

    initialValue: {
      required: false,
      type: String,
      default: "",
    },

    name: {
      required: false,
      type: String,
      default: "text_input_combo",
    },

    inputType: {
      required: false,
      type: String,
      default: "text",
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

    placeholderText: {
      required: false,
      type: String,
      default: "",
    },

    inputIsRequired: {
      required: false,
      type: Boolean,
      default: false,
    },

    inputId: {
      required: false,
      type: String,
      default: null,
    },

    isDisabled: {
      required: false,
      type: Boolean,
      default: false,
    },

    uniqueId: {
      required: false,
      type: String,
      default: "",
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~sass/error_message_box";
@import "~sass/fonts";

.icon-container {
  top: 0;
  right: 0;
  transform: translate(50%, -50%);
  position: absolute;
}

.disabled-input-icon {
  top: 50%;
  transform: translateY(-50%);
  right: 1%;
  position: absolute;
  fill: red;
  width: 1em;
  height: auto;
}

.text-input-combo-value-label {
  display: flex;
  align-items: baseline;
  background: #242229;
  padding: 3px 10px;
  border-radius: 8px;
  color: white;
  width: 95%;
  margin: 0 auto;
  border: 2px solid transparent;
  position: relative;
  height: 2em;
}

.text-input-description {
  white-space: nowrap;
}

.text-input-combo-value {
  background: #242229;
  border: none;
  border-bottom: 1px solid transparent;
  color: #fff;
  width: 1%;
  flex-grow: 10;
  padding-left: 4px;
  box-shadow: 0 0 0 1000px #242229 inset;
  &:-webkit-autofill {
    -webkit-text-fill-color: white;
    font: inherit;
    border: none;
  }

  &:-webkit-autofill:focus {
    -webkit-text-fill-color: white;
    font: inherit;
  }
  &:-webkit-autofill:hover {
    -webkit-text-fill-color: white;
    font: inherit;
  }
}

.text-input-combo-value,
.text-input-description,
.text-input-combo-value-label {
  @include responsive-font;
}

.text-input-combo-value:focus {
  outline: none;
  border-bottom: 1px solid #86838f;
}

.incorrect-value {
  border: 2px solid red;
}

.correct-value {
  border: 2px solid green;
}
</style>
