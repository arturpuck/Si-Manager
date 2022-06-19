<template>
  <div class="textarea-combo-container">
    <label
      for="textarea-combo-message"
      v-bind:class="{ 'phantom-label': phantomLabel }"
      class="message-label"
      ><slot></slot
    ></label>
    <div class="textarea-wrapper">
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
      <textarea
        v-model="inputValue"
        v-on:blur="emitBlur"
        v-bind:max="maxCharacters"
        v-bind:placeholder="placeholderText"
        :required="inputIsRequired"
        id="textarea-combo-message"
        v-bind:name="textareaName"
        v-bind:rows="rowsNumber"
        v-bind:class="{
          'incorrect-value': displayRedBorder,
          'correct-value': displayGreenBorder,
        }"
        class="textarea-combo-message"
      ></textarea>
      <div
        v-if="errorMessageBoxAvailable"
        v-text="errorMessage"
        class="error-message-box"
      ></div>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Options, Prop, Emit } from "vue-property-decorator";
import ComboInputBasicFunctionality from "@mixins/components/comboInputs/comboInputBasicFunctionality";

@Options({ name: "TextareaCombo", mixins : [ComboInputBasicFunctionality], emits : ['blur'] })
export default class TextAreaCombo extends Vue {
  @Prop({
    type: String,
    required: false,
    default: "",
  })
  readonly initialValue: string;

  @Prop({
    type: String,
    required: false,
    default: "textarea_combo",
  })
  readonly textareaName: string;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly errorIconAvailable: boolean;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly confirmationIconAvailable: boolean;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly redBorderAvailable: boolean;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly greenBorderAvailable: boolean;

  @Prop({
    type: Boolean,
    required: false,
    default: undefined,
  })
  readonly initialOk: boolean;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly completeErrorDisplayAvailable: boolean;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly completeConfirmationDisplayAvailable: boolean;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly completeValidationDisplayAvailable: boolean;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly errorMessageBoxAvailable: boolean;

  @Prop({
    type: String,
    required: false,
    default: undefined,
  })
  readonly initialErrorText: string;

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
    type: Number,
    required: false,
    default: undefined,
  })
  readonly maxCharacters: number;

  @Prop({
    type: Number,
    required: false,
    default: 6,
  })
  readonly rowsNumber: number;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly phantomLabel: boolean;

  @Prop({
    type: String,
    required: false,
    default: '',
  })
  readonly uniqueId: boolean;

  private valueOK: boolean = null;
  private errorMessage: string = '';
  private inputValue = '';
  private iconErrorCanBeDisplayed: boolean = false;
  private iconConfirmationCanBeDisplayed: boolean = false;
  private redBorderCanBeDisplayed: boolean = false;
  private greenBorderCanBeDisplayed: boolean = false;

  get displayIconError() {
    return this.iconErrorCanBeDisplayed && this.valueOK === false;
  }

  get displayRedBorder() {
    return this.redBorderCanBeDisplayed && (this.valueOK === false);
  }

  get displayIconConfirmation() {
    return this.iconConfirmationCanBeDisplayed && this.valueOK === true;
  }

  get displayGreenBorder() {
    return this.greenBorderCanBeDisplayed && this.valueOK === true;
  }

  emitBlur(){
    this.$emit("blur", this.inputValue);
  }

  created() {
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
    
  }

  mounted() {
    //@ts-ignore
    this.attachEventListeners();
  }
}
</script>

<style lang="scss">
@import "~sass/error_message_box";
@import "~sass/fonts";

.textarea-wrapper {
  position: relative;
}

.message-label {
  text-align: center;
  color: white;
  display: block;
  padding: 3px 0px;
  @include responsive-font(1.4vw, 20px);
}

.phantom-label {
  position: absolute;
  top: -9999px;
  left: 0;
}

.textarea-combo-container {
  width: 95%;
  margin: 10px auto;
}

.textarea-combo-message {
  width: 100%;
  display: block;
  border-radius: 8px;
  background: #242229;
  color: white;
  border: 2px solid transparent;
  resize: none;
  color: white;
  @include responsive-font;
  &:focus {
    outline: none;
    border: 2px solid #6e0d1a;
  }
}

.incorrect-value {
  border: 2px solid red;
}

.correct-value {
  border: 2px solid green;
}
</style>