<template>
  <label v-bind:class="{containsData : showsSelectedValue}" class="labeled-range">
    <span class="labeled-range__description">
      <slot></slot>
    </span>
    <input
      type="range"
      v-bind:min="min"
      v-bind:max="max"
      v-bind:value="modelValue"
      v-on:input="updateModel"
      class="labeled-range__value"
    />
    <span class="labeled-range__displayed-value" v-text="displayedValue"></span>
  </label>
</template>

<script lang="ts">
export default {
  props: {
    modelValue: {
      required: false,
      type: Number,
      default: undefined,
    },

    min: {
      required: false,
      type: Number,
      default: 0,
    },

    max: {
      required: false,
      type: Number,
      default: 100,
    },

    unit: {
      required: false,
      type: String,
      default: "",
    },

    shouldShowWhenValueIsSelected : {
      required : false,
      type: Boolean,
      default: true,
    }
  },

  methods: {
    updateModel(event): void {
      this.$emit("update:modelValue", parseInt(event.target.value));
    },
  },

  computed: {
    displayedValue(): string {
      return this.modelValue + " " + this.unit;
    },

    showsSelectedValue() : boolean {
     return Boolean(this.shouldShowWhenValueIsSelected && this.modelValue);
  }
  },
};
</script>
<style lang="scss" scoped>
@import "~sass/fonts";


.labeled-range {
  border-radius: 7px;
  padding: 3px 10px;
  color: white;
  background: #242229;
  position: relative;
  border: 2px solid transparent;
  @include responsive-font(1.2vw, 16px);
  height: 2em;
  display: flex;
  align-items: center;

  &__description {
    line-height: 1em;
    white-space: nowrap;
  }

  &__displayed-value {
    white-space: nowrap;
  }

  &__value {
      height: 25px;
      -webkit-appearance: none;
      margin: 6px;
      width: 100%;
    &:focus {
      outline: none;
    }
    &::-webkit-slider-runnable-track {
      width: 100%;
      height: 5px;
      cursor: pointer;
      animate: 0.2s;
      box-shadow: 0px 0px 0px #000000;
      background: #2497e3;
      border-radius: 1px;
      border: 0px solid #000000;
    }
    &::-webkit-slider-thumb {
      box-shadow: 0px 0px 0px #000000;
      border: 1px solid #2497e3;
      height: 18px;
      width: 18px;
      border-radius: 25px;
      background: #a1d0ff;
      cursor: pointer;
      -webkit-appearance: none;
      margin-top: -7px;
    }
    &:focus::-webkit-slider-runnable-track {
      background: #2497e3;
    }
    &::-moz-range-track {
      width: 100%;
      height: 5px;
      cursor: pointer;
      animate: 0.2s;
      box-shadow: 0px 0px 0px #000000;
      background: #2497e3;
      border-radius: 1px;
      border: 0px solid #000000;
    }
    &::-moz-range-thumb {
      box-shadow: 0px 0px 0px #000000;
      border: 1px solid #2497e3;
      height: 18px;
      width: 18px;
      border-radius: 25px;
      background: #a1d0ff;
      cursor: pointer;
    }
    &::-ms-track {
      width: 100%;
      height: 5px;
      cursor: pointer;
      animate: 0.2s;
      background: transparent;
      border-color: transparent;
      color: transparent;
    }
    &::-ms-fill-lower {
      background: #2497e3;
      border: 0px solid #000000;
      border-radius: 2px;
      box-shadow: 0px 0px 0px #000000;
    }
    &::-ms-fill-upper {
      background: #2497e3;
      border: 0px solid #000000;
      border-radius: 2px;
      box-shadow: 0px 0px 0px #000000;
    }
    &::-ms-thumb {
      margin-top: 1px;
      box-shadow: 0px 0px 0px #000000;
      border: 1px solid #2497e3;
      height: 18px;
      width: 18px;
      border-radius: 25px;
      background: #a1d0ff;
      cursor: pointer;
    }
    &:focus::-ms-fill-lower {
      background: #2497e3;
    }
    &:focus::-ms-fill-upper {
      background: #2497e3;
    }
  }
}

.containsData {
  border: 2px solid rgb(21, 177, 21);
}
</style>