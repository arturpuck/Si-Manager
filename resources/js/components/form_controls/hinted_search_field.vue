<template>
  <div
    class="search-field-container"
    v-bind:class="{
      'focused-input-container': focus,
      'top-corners-rounded-container': hintsAreDisplayed,
    }"
  >
    <label
      v-text="description"
      for="hinted-search-text"
      class="search-field-description"
    ></label>
    <div
      v-bind:class="{ 'top-left-corner-rounded': hintsAreDisplayed }"
      class="icon-container"
    >
      <magnifier-icon class="decoration-icon"></magnifier-icon>
    </div>
    <input
      v-bind:placeholder="placeholderText"
      v-on:focus="toggleFocus"
      v-on:focusout="toggleFocus(true)"
      v-bind:value="modelValue"
      v-on:input="emitTypedInValue"
      id="hinted-search-text"
      type="search"
      class="search-value"
    />
    <button
      v-text="translations['search']"
      v-bind:class="{ 'top-right-corner-rounded': hintsAreDisplayed }"
      v-on:click="startSearching(modelValue)"
      class="search-button"
    ></button>
    <ul v-bind:class="{ 'visible-hints-list': hintsAreDisplayed }" class="hints-list">
      <li
        v-for="hint in hints"
        v-text="hint"
        v-on:click="startSearching(hint)"
        class="hint"
      ></li>
    </ul>
  </div>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";
import Translator from "@jsmodules/translator.js";
import MagnifierIcon from "@svgicon/magnifier_icon.vue";

@Options({ name: "HintedSearchField", components : {MagnifierIcon} })
export default class HintedSearchField extends Vue {
  @Prop({
    type: String,
    required: false,
  })
  readonly modelValue: string;

  @Prop({
    type: String,
    required: false,
    default: "",
  })
  readonly placeholderText: string;

  @Prop({
    type: Array,
    required: false,
    default: [],
  })
  readonly hints: Array<string>;

  @Prop({
    type: String,
    required: true,
  })
  readonly description: string;

  private translations = Translator.getPackage("hinted_search_field");
  private focus = false;

  get hintsAreDisplayed(): boolean {
    return this.hints.length > 0 && this.focus;
  }

  toggleFocus(delayed = false) {
    const toggle = () => (this.focus = !this.focus);

    if (delayed) {
      setTimeout(toggle, 500);
    } else {
      toggle();
    }
  }

  emitTypedInValue(event) {
    this.emitUserTypesTextInSearchFiled(event.target.value);
  }

  startSearching(hint: string) {
    this.emitUserTypesTextInSearchFiled(hint);
    this.emitValueHasBeenChosen(hint);
  }

  emitValueHasBeenChosen(value: string) {
    this.$emit("valueInHintedSearchFieldHasBeenChosen", value);
  }

  emitUserTypesTextInSearchFiled(value: string) {
    this.$emit("update:modelValue", value);
  }
}
</script>

<style lang="scss">
@import "~sass/fonts";

.decoration-icon {
  width:1em;
  height:auto;
  fill:white;
  margin: 3px;
}

.hint {
  padding: 4px 0;
  border-top: 1px solid #312d3c;
  @include responsive-font(1.3vw, 18px, Aldrich);
  color: white;
  cursor: pointer;
  &:hover {
    background: #a00b41;
  }
}

.magnifier-icon {
  color: white;
  margin: 0 5px;
}

.icon-container {
  background: linear-gradient(#f1165d, #7b0e1d);
  display: inline-flex;
  align-items: center;
  border-radius: 10px 0 0 10px;
}

.search-button {
  cursor: pointer;
  background: linear-gradient(#f1165d, #7b0e1d);
  border-radius: 0 10px 10px 0;
  border: none;
  outline: none;
  color: #f1d6d6;
  padding: 5px;
  @include responsive-font(1.5vw, 18px, Aldrich);
}

.search-field-container {
  position: relative;
  @include responsive-font(1.5vw, 18px);
  background: #312d3c;
  border: 2px solid #670815;
  background: #201c29;
  border-radius: 10px;
  border: 2px solid #312d3c;
  display: inline-flex;
  align-items: stretch;
}

.top-corners-rounded-container {
  border-radius: 10px 10px 0 0;
}

.top-left-corner-rounded {
  border-radius: 10px 0 0 0;
}

.top-right-corner-rounded {
  border-radius: 0 10px 0 0;
}

.focused-input-container {
  border: 2px solid white;
}

.search-value {
  background: transparent;
  min-width: 150px;
  width: 20vw;
  outline: none;
  border: none;
  @include responsive-font(1.4vw, 17px);
  color: white;
  padding-left: 5px;
}

.hints-list {
  position: absolute;
  top: 100%;
  width: calc(100% + 4px);
  left: -2px;
  list-style-type: none;
  margin: 0;
  padding: 0;
  z-index: 2;
  background: #201c29;
  border-radius: 0 0 10px 10px;
  overflow: hidden;
  display: none;
}

.visible-hints-list {
  border-left: 2px solid white;
  border-right: 2px solid white;
  border-bottom: 2px solid white;
  display: block;
}

.search-field-description {
  position: absolute;
  left: 0;
  top: -9999px;
}
</style>
