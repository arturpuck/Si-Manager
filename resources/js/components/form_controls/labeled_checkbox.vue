<template>
  <div class="labeled-checkbox-container">
    <input
      v-bind:checked="modelValue"
      v-bind:value="checkboxValue"
      v-on:input="updateModel"
      ref="checkbox"
      type="checkbox"
      class="labeled-checkbox"
      v-bind:name="name"
      v-bind:id="name"
    />
    <label ref="label" v-bind:for="name" class="labeled-checkbox-description"
      ><slot></slot
    ></label>
  </div>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";

@Options({ name: "LabeledCheckbox" })
export default class LabeledCheckbox extends Vue {
  @Prop({
    type: String,
    required: false,
    default: "labeled-checkbox",
  })
  readonly name: string;

  @Prop({
    type: Object,
    required: false,
    default: undefined,
  })
  readonly aditionalClasses: object;

  @Prop({
    type: Boolean,
    required: false,
    default: false,
  })
  readonly checkedAtStart: boolean;

  @Prop({
    required: false,
    default: false,
  })
  readonly modelValue;

  @Prop({
    required: false,
    default: 1,
  })
  readonly checkboxValue;

  private checked: boolean = false;

  updateModel(event) {
    this.$emit("update:modelValue", event.target.checked);
  }

  mounted() {
    if (this.aditionalClasses) {
      Object.keys(this.aditionalClasses).forEach((key) =>
        (<HTMLElement>this.$refs[key]).classList.add(this.aditionalClasses[key])
      );
    }

    (<HTMLInputElement>this.$refs.checkbox).checked = this.checkedAtStart;
    this.$emit("input", this.checkedAtStart);
  }
}
</script>

<style lang="scss" scoped>
.labeled-checkbox {
  opacity: 0;
}

.labeled-checkbox-description {
  position: relative;
  padding: 0 8px;
  line-height: 1em;
  &:before {
    content: "";
    display: inline-block;
    position: absolute;
    top: 0;
    left: -1.2vw;
    width: 1.2vw;
    height: 1.2vw;
    cursor: pointer;
    background: white;
    border: none;
    border-radius: 2px;
    z-index: 1;
  }
  &:after {
    content: "";
    display: inline-block;
    position: absolute;
    top: 0;
    left: -0.8vw;
    width: 0.3vw;
    height: 0.8vw;
    cursor: pointer;
    border-bottom: 2px solid white;
    border-right: 2px solid white;
    z-index: 2;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    opacity: 0;
  }
}

@media (max-width: 1200px) {
  .labeled-checkbox-description:before {
    left: -16px;
    width: 16px;
    height: 16px;
  }

  .labeled-checkbox-description:after {
    left: -11px;
    width: 5px;
    height: 12px;
  }
}

.labeled-checkbox-container {
  display: inline-flex;
  align-items: center;
  padding:2px 1.2vw;
  cursor: pointer;
}

.labeled-checkbox:hover + .labeled-checkbox-description:before {
  background: #e80e53;
}

.labeled-checkbox:checked + .labeled-checkbox-description:before {
  background: #e80e53;
}

.labeled-checkbox:checked + .labeled-checkbox-description:after {
  opacity: 1;
}
</style>
