<template>
  <button type="button" class="show-comment-form-button">
    <span v-text="caption" class="show-comment-form-button__caption"></span>
    <writing-comment-icon class="show-comment-form-button__icon"></writing-comment-icon>
  </button>
</template>

<script lang="ts">
import { Vue, Options } from "vue-property-decorator";
import WritingCommentIcon from "@svgicon/writing_comment_icon.vue";
import Translator from "@jsmodules/translator.js";

@Options({ name: "ShowCommentFormButton", components: { WritingCommentIcon } })
export default class ShowCommentFormButton extends Vue {
  private caption = Translator.translate("publish_comment");
}
</script>

<style lang="scss" scoped>
@import "~sass/fonts";
@import "~sass/responsive_icon";

.show-comment-form-button {
  background: linear-gradient(#0fe00b, #054004);
  padding: 1vw;
  border-radius: 5px;
  display: flex;
  width: max-content;
  border: none;
  align-items: center;
  cursor: pointer;

  &:hover {
    background: #ef0244;
  }

  &__caption {
    color: white;
    @include responsive-font(1.8vw, 20px);
  }

  &__icon {
    @include responsive-icon(0 5px, 2vw, 25px);
    fill: white;
  }
}
</style>
