<template>
  <div aria-hidden="true" class="logo-container">
    <heart-rate-icon class="empire-logo"></heart-rate-icon>
    <span
      aria-hidden="true"
      v-text="logoDescription"
      class="logo-description logo-description-long"
    ></span>
    <span
      aria-hidden="true"
      v-text="logoDescriptionShort"
      class="logo-description logo-description-short"
    ></span>
  </div>
</template>

<script>
import Translator from "@jsmodules/translator.js";
import HeartRateIcon from "@svgicon/heart_rate_icon.vue";

export default {
  name: "empire-logo",

  components: {
    HeartRateIcon,
  },

  data() {
    return {
      logoDescription: "",
      logoDescriptionShort: "",
    };
  },

  mounted() {
    this.translator = Translator;
    this.logoDescription = this.translator.translate("sex_empire");
    this.logoDescriptionShort = this.translator.translate("sex_empire_short");
  },
};
</script>

<style lang="scss" scoped>
@import "~sass/fonts";

.logo-description {
  @include responsive-font(1em, 1em);
  color: white;
}

.logo-container {
  display: inline-block;
}

.empire-logo {
  width: 0.9em;
  margin-right: 2px;
  fill: #eb091c;
  vertical-align: baseline;
}

.logo-description-short {
  @media (max-width: 550px) {
    display: inline;
  }

  @media (min-width: 551px) {
    display: none;
  }
}

.logo-description-long {
  @media (max-width: 550px) {
    display: none;
  }

  @media (min-width: 551px) {
    display: inline;
  }
}
</style>
