<template>
  <div>
    <div v-click-away="hideMenu" class="multiselect">
      <div class="multiselect__label" v-on:click="showMenu">
        <span v-text="mainLabel" class="multiselect__caption"></span>
        <icon-add-plus></icon-add-plus>
      </div>
      <div
        class="multiselect__menu"
        v-bind:class="{ 'multiselect__menu--visible': menuIsVisible }"
      >
        <label v-if="showSearchInput">
          <div
            v-text="searchInputCaption"
            class="multiselect__search-input-caption"
          ></div>
          <input
            v-on:input="searchForValue"
            class="multiselect__search-input"
            id=""
            type="search"
          />
        </label>
        <ul class="multiselect__options">
          <li
            v-for="(option, key) in totalOptions"
            v-show="optionShouldBeDisplayed(key)"
            class="multiselect__option"
          >
            <labeled-checkbox
              v-on:click="updateModel"
              v-model="optionsStates[key]"
              v-bind:name="key"
              class="option-checkbox"
            >
              {{ option }}
            </labeled-checkbox>
          </li>
        </ul>
      </div>
    </div>
    <ul class="multiselect__selected-options-list">
      <li v-for="(option, key) in selectedOptions" class="multiselect__selected-option">
        {{ option }}
        <button-close
          v-on:click="removeSelectedOption(key)"
          class="button-close--smaller"
        ></button-close>
      </li>
    </ul>
  </div>
</template>

<script lang="ts">
import { Vue, Options, Prop, Watch } from "vue-property-decorator";
import Translations from "@jsmodules/translations/components/form_controls/multiselect.js";
import IconAddPlus from "@jscomponents/decoration/icons/icon_add_plus.vue";
import LabeledCheckbox from "@jscomponents/form_controls/labeled_checkbox.vue";
import { directive } from "vue3-click-away";
import ButtonClose from "@jscomponents/form_controls/button_close.vue";

@Options({
  name: "MultiSelect",
  components: { IconAddPlus, LabeledCheckbox, ButtonClose },
  directives: { ClickAway : directive },
})
export default class MultiSelect extends Vue {
  private displayedOptions: object = {};
  private totalOptions: object = {};
  private menuIsVisible: boolean = false;
  private optionsStates: object = {};
  private translations = Translations;
  private selectedOptions: object = {};

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly showSearchInput: boolean;

  @Prop({
    type: Array,
    required: false,
    default: () => [],
  })
  readonly options: Array<any>;

  @Prop({
    type: String,
    required: false,
    default: Translations["defaultLabel"],
  })
  readonly mainLabel: string;

  @Prop({
    type: String,
    required: false,
    default: "Multiselect",
  })
  readonly id: string;

  @Prop({
    type: String,
    required: false,
    default: Translations["defaultSearchInputCaption"],
  })
  readonly searchInputCaption: string;

  @Prop({
    type: Array,
    required: false,
    default: [],
  })
  readonly modelValue: Array<any>;

  @Watch("modelValue", {deep : true})
  modelChanged(modelValue: Array<any>, oldValue: Array<any>) {
    let innerSelectedOptions: object = {};

    Object.keys(this.totalOptions).forEach((key) => {
      const option = this.totalOptions[key];
      const isSelected = modelValue.includes(option);
      this.optionsStates[key] = isSelected;
      if (isSelected) {
        innerSelectedOptions[key] = option;
      }
    });

    this.selectedOptions = innerSelectedOptions;
  }

  optionShouldBeDisplayed(key: string): boolean {
    return this.displayedOptions.hasOwnProperty(key);
  }

  removeSelectedOption(key: string) {
    this.optionsStates[key] = false;
    delete this.selectedOptions[key];
    this.updateModel();
  }

  updateModel() {
    setTimeout(() => this.$emit("update:modelValue", this.getSelectedOptions(), 0));
  }

  getSelectedOptions(): Array<any> {
    let selectedOptions: Array<any> = [];
    let innerSelectedOptions: object = {};

    Object.keys(this.optionsStates).forEach((key) => {
      if (this.optionsStates[key]) {
        let optionValue = this.totalOptions[key];
        selectedOptions.push(optionValue);
        innerSelectedOptions[key] = optionValue;
      }
    });
    this.selectedOptions = innerSelectedOptions;

    return selectedOptions;
  }

  created() {
    this.replaceAvailableOptions(this.options);
    //@ts-ignore
    this.emitter.on(`replaceAvailableOptionsFor${this.id}`, this.replaceAvailableOptions);
  }

  replaceAvailableOptions(options: Array<any>) {
    this.totalOptions = this.getOptionsWithObjectProperties(options);
    this.displayedOptions = this.totalOptions;
    Object.keys(this.displayedOptions).forEach((key) => {
      this.optionsStates[key] = false;
    });
  }

  getOptionsWithObjectProperties(options: Array<any>): object {
    const optionsWithKeys: object = {};

    options.forEach((option) => {
      const identifier = this.parseOptionValueToObjectProperty(option);
      optionsWithKeys[identifier] = option;
    });

    return optionsWithKeys;
  }

  parseOptionValueToObjectProperty(value): string {
    const str = value.toString();
    return `_${str.replace(/ /g, "_").replace(/-/g, "_")}`;
  }

  searchForValue(event) {
    const value = event.target.value.toLowerCase();

    if (value) {
      let matchingValues: object = {};

      Object.keys(this.totalOptions).forEach((key) => {
        let optionLowercase = this.totalOptions[key].toLowerCase();

        if (optionLowercase.includes(value)) {
          matchingValues[key] = this.totalOptions[key];
        }
      });

      this.displayedOptions = matchingValues;
    } else {
      this.displayedOptions = this.totalOptions;
    }
  }

  showMenu(event) {
    this.menuIsVisible = true;
  }

  hideMenu() {
    this.menuIsVisible = false;
  }
}
</script>

<style lang="scss" scoped>
@import "~sass/fonts";
@import "~sass/nice_scrollbar";
@mixin naked-list {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.option-checkbox {
  color:white;
}

.multiselect {
  position: relative;
  padding: 4px;
  border-radius: 7px;
  background: #242229;
  cursor: pointer;
  @include responsive-font();

  &__search-input-caption {
    text-align: center;
    color: white;
  }

  &__label {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  &__caption {
    color: white;
  }

  &__options {
    @include naked-list();
  }

  &__option {
    margin: 5px 0;
  }

  &__menu {
    position: absolute;
    width: 100%;
    left: 0;
    top: 100%;
    overflow-y: auto;
    z-index: 5;
    padding: 0;
    background: black;
    max-height: 0;

    &--visible {
      max-height: 25vh;
      padding: 0.5vw;
    }
  }

  &__search-input {
    background: #f7ecf0;
    border: 2px solid transparent;
    outline: none;
    border-radius: 3px;
    width: 100%;
    @include responsive-font();
    margin: 5px 0;
    &:focus {
      border: none;
      border: 2px solid crimson;
      outline: none;
    }
  }

  &__selected-options-list {
    @include naked-list();
    @include responsive-font(1.1vw, 13px);
    max-height: 8em;
    overflow: auto;
  }

  &__selected-option {
    display: inline-block;
    background: linear-gradient(#12d012, #265005);
    border-radius: 3px;
    padding: 2px 4px;
    margin: 4px 2px;
    color: white;
  }
}

.button-close--smaller {
  min-width: 20px;
  min-height: 20px;
  width: 1.5vw;
  height: 1.5vw;
  vertical-align: middle;
  margin-left: 3px;
}

@include nice-scrollbar(".multiselect__menu");
@include nice-scrollbar(".multiselect__selected-options-list");
</style>
