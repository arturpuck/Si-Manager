<template>
  <relative-shadow-container>
    <expect-circle v-bind:label="circleLabel"></expect-circle>
  </relative-shadow-container>
</template>

<script lang="ts">
import { Vue, Options, Prop } from "vue-property-decorator";
import RelativeShadowContainer from "@jscomponents/decoration/relative_shadow_container.vue";
import ExpectCircle from "@jscomponents/decoration/expect_circle.vue";

@Options({
  name: "ExpectShadowCircle",
  components: {
    RelativeShadowContainer,
    ExpectCircle,
  },
})
export default class ExpectShadowCircle extends Vue {
  @Prop({
    type: String,
    required: false,
    default: "",
  })
  readonly circleLabel: string;
}
</script>
