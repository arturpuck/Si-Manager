<template>
  <div class="date-picker-container">
    <input
      type="hidden"
      v-bind:disabled="isDisabled"
      v-bind:value="dateString"
      v-bind:name="name"
    />
    <div class="date-picker-description">
      <slot></slot>
      <padlock-icon
        v-if="isDisabled"
        class="disabled-input-icon"
      ></padlock-icon>
    </div>
    <div
      v-bind:class="{
        'incorrect-value': displayRedBorder,
        'correct-value': displayGreenBorder,
      }"
      class="date-picker-flex-container"
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
      <div class="time-span-container">
        <label for="date-picker-day" class="time-span-label">{{
          descriptions["day"]
        }}</label>
        <select
          v-bind:disabled="isDisabled"
          v-on:change="adjustDays"
          ref="day_select"
          v-model="selectedDay"
          id="date-picker-day"
          class="time-span-select"
        >
          <option value="0">--{{ descriptions["day"] }}--</option>
          <option v-for="day in numberOfDaysInMonth" v-bind:value="day">
            {{ day }}
          </option>
        </select>
      </div>

      <div class="time-span-container">
        <label for="date-picker-month" class="time-span-label">{{
          descriptions["month"]
        }}</label>
        <select
          v-bind:disabled="isDisabled"
          v-on:change="adjustDays"
          v-model="selectedMonth"
          id="date-picker-month"
          class="time-span-select"
        >
          <option value="0">--{{ descriptions["month"] }}--</option>
          <option v-for="(month, index) in months" v-bind:value="index + 1">
            {{ month }}
          </option>
        </select>
      </div>

      <div class="time-span-container">
        <label for="date-picker-year" class="time-span-label">{{
          descriptions["year"]
        }}</label>
        <select
          v-bind:disabled="isDisabled"
          v-on:change="adjustDays"
          v-model="selectedYear"
          id="date-picker-year"
          class="time-span-select"
        >
          <option value="0">--{{ descriptions["year"] }}--</option>
          <option v-for="n in timespan" v-bind:value="lastYear - n + 1">
            {{ lastYear - n + 1 }}
          </option>
        </select>
      </div>
    </div>
    <div
      v-if="errorMessageBoxAvailable"
      v-text="errorMessage"
      class="error-message-box"
    ></div>
  </div>
</template>

<script lang="ts">
import MonthsInDifferentLanguages from "@jsmodules/months_in_different_languages.js";
import PadlockIcon from "@svgicon/padlock_icon.vue";
import IconStop from "@jscomponents/decoration/icon_stop.vue";
import IconConfirm from "@jscomponents/decoration/icon_confirm.vue";
import ComboInputBasicFunctionality from "@mixins/components/comboInputs/comboInputBasicFunctionality";

export default {
  name: "date-picker",

  emits : ['selected'],

  mixins: [ComboInputBasicFunctionality],

  props: {
    language: {
      required: false,
      type: String,
      default: "Polski",
    },

    initialValue: {
      required: false,
      type: String,
      default: "00-00-00",
    },

    name: {
      required: false,
      type: String,
      default: "date_picker",
    },

    sinceYear: {
      required: false,
      type: Number,
      default: new Date().getFullYear() - 120,
    },

    lastYear: {
      required: false,
      type: Number,
      default: new Date().getFullYear(),
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

  components: {
    PadlockIcon,
    IconStop,
    IconConfirm,
  },

  methods: {
    considerEmittingEvent(): void {
      if (this.eventShouldBeEmitted) {
          this.$emit("selected", this.dateString);
      }
      else { 
        this.resetValidation();
      }
    },

    adjustDays() {
      const selectedMonth = this.selectedMonth;
      if (selectedMonth != "0") {
        const months31 = [1, 3, 5, 7, 8, 10, 12];
        const months30 = [4, 6, 9, 11];
        const selectedYear = this.selectedYear;

        if (months31.includes(selectedMonth)) {
          this.numberOfDaysInMonth = 31;
        } else if (months30.includes(selectedMonth)) {
          this.numberOfDaysInMonth = 30;
        } else {
          this.numberOfDaysInMonth =
            selectedYear % 4 === 0 && selectedYear !== 0 ? 29 : 28;
        }

        this.selectedDay =
          this.selectedDay > this.numberOfDaysInMonth
            ? this.numberOfDaysInMonth
            : this.selectedDay;

      } else {
        this.numberOfDaysInMonth = 31;
      }
        this.considerEmittingEvent();
    },

    initiateDate() {
      if (this.initialValue !== "00-00-00") {
        const splittedDate = this.initialValue.split("-");
        this.selectedYear = splittedDate[0];
        this.selectedMonth = splittedDate[1].replace("0", "");
        this.selectedDay = splittedDate[2].replace("0", "");
      }
    },

    initiateSettings(): void {
      this.months = MonthsInDifferentLanguages[this.language]["months"];
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
      this.timespan = this.lastYear - this.sinceYear + 1;
      this.descriptions =
        MonthsInDifferentLanguages[this.language]["timeSpanNames"];
      this.valueOK = this.initialOk;
      this.initiateDate();
    },
  },

  data() {
    return {
      valueOK: undefined,
      errorMessage: undefined,
      months: undefined,
      timespan: undefined,
      numberOfDaysInMonth: 31,
      selectedDay: 0,
      selectedMonth: 0,
      selectedYear: 0,
      descriptions: undefined,
    };
  },

  created() {
    this.initiateSettings();
    this.attachEventListeners();
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

    eventShouldBeEmitted() : boolean {
      return this.selectedDay != "0" && this.selectedMonth != "0" && this.selectedYear != "0"
    },

    dateString() {
      return `${this.selectedYear
        .toString()
        .padStart(2, "0")}-${this.selectedMonth
        .toString()
        .padStart(2, "0")}-${this.selectedDay.toString().padStart(2, "0")}`;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~sass/fonts";
@import "~sass/error_message_box";

.date-picker-container {
  color: white;
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

.date-picker-description {
  text-align: center;
  position: relative;
  padding: 3px;
  color: white;
  @include responsive-font(1.3vw, 17px);
}

.date-picker-flex-container {
  display: flex;
  border-radius: 8px;
  justify-content: space-evenly;
  background: #242229;
  padding: 3px 7px;
  border: 2px solid transparent;
  position: relative;
  width: 95%;
  height: 2em;
  margin: 0 auto;
  @include responsive-font(1vw, 14px);
  align-items: center;
}

.time-span-select {
  border-radius: 4px;
  background: #242229;
  color: white;
  border: 1px solid black;
  @include responsive-font(1vw, 14px);
}

.time-span-label {
  position: absolute;
  top: -9999px;
  left: -9999px;
}

.time-span-container {
  padding: 2px;
  border-radius: 6px;
}

.incorrect-value {
  border: 2px solid red;
}

.correct-value {
  border: 2px solid green;
}
</style>
