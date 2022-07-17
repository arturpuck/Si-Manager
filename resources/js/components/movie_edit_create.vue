<template>
  <div>
    <form>
      <simple-labeled-input class="movie-description" v-model="title"
        >{{ descriptionsTranslations["title"] }} :
      </simple-labeled-input>
      <simple-labeled-input class="movie-description" v-model="description"
        >{{ descriptionsTranslations["description"] }} :
      </simple-labeled-input>
      <div class="add-movie-panel">
        <fieldset class="panel-group">
          <legend class="panel-group-legend">
            {{ descriptionsTranslations["actress_body_and_type"] }}
          </legend>
          <simple-labeled-select
            v-model="actress_tits_size"
            v-bind:options="movieCreatorTranslations['actress_tits_size']"
            >{{
              descriptionsTranslations["tits_size"]
            }}
            :</simple-labeled-select
          >
          <simple-labeled-select
            v-model="actress_ass_size"
            v-bind:options="movieCreatorTranslations['actress_ass_size']"
          >
            {{ descriptionsTranslations["ass_size"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="actress_thickness"
            v-bind:options="movieCreatorTranslations['actress_thickness']"
          >
            {{ descriptionsTranslations["thickness"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="actress_age_range"
            v-bind:options="movieCreatorTranslations['actress_age_range']"
          >
            {{ descriptionsTranslations["age"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="actress_hair_color"
            v-bind:options="movieCreatorTranslations['actress_hair_color']"
          >
            {{ descriptionsTranslations["hair_color"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="actress_race"
            v-bind:options="movieCreatorTranslations['actress_race']"
          >
            {{ descriptionsTranslations["actress_race"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="actress_nationality"
            v-bind:options="movieCreatorTranslations['actress_nationality']"
          >
            {{ descriptionsTranslations["actress_nationality"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="shows_shaved_pussy"
            v-bind:options="movieCreatorTranslations['binaryOptions']"
          >
            {{ descriptionsTranslations["shaved_pussy"] }} :
          </simple-labeled-select>
        </fieldset>
        <fieldset class="panel-group">
          <legend class="panel-group-legend">
            {{ descriptionsTranslations["sex_type"] }}
          </legend>
          <simple-labeled-select
            v-model="abundance"
            v-bind:options="movieCreatorTranslations['abundance']"
          >
            {{ descriptionsTranslations["abundance"] }} :
          </simple-labeled-select>
          <labeled-range
            class="sex-ammount"
            v-model="anal_percentage"
            unit="%"
            >{{ descriptionsTranslations["anal"] }}</labeled-range
          >
          <labeled-range
            class="sex-ammount"
            v-model="blowjob_percentage"
            unit="%"
            >{{ descriptionsTranslations["blowjob"] }}</labeled-range
          >
          <labeled-range
            class="sex-ammount"
            v-model="pussy_fuck_percentage"
            unit="%"
            >{{ descriptionsTranslations["vaginal"] }}</labeled-range
          >
          <labeled-range
            class="sex-ammount"
            v-model="handjob_percentage"
            unit="%"
            >{{ descriptionsTranslations["handjob"] }}</labeled-range
          >
          <labeled-range
            class="sex-ammount"
            v-model="pussy_licking_percentage"
            unit="%"
            >{{ descriptionsTranslations["pussy_licking"] }}</labeled-range
          >
          <labeled-range
            class="sex-ammount"
            v-model="tittfuck_percentage"
            unit="%"
            >{{ descriptionsTranslations["tittfuck"] }}</labeled-range
          >
          <labeled-range
            class="sex-ammount"
            v-model="feet_petting_percentage"
            unit="%"
            >{{ descriptionsTranslations["feet"] }}</labeled-range
          >
          <labeled-range
            class="sex-ammount"
            v-model="double_penetration_percentage"
            unit="%"
            >{{ descriptionsTranslations["double_penetration"] }}</labeled-range
          >
          <labeled-range
            class="sex-ammount"
            v-model="position_69_percentage"
            unit="%"
            >{{ descriptionsTranslations["position_69"] }}</labeled-range
          >

          <simple-labeled-select
            v-model="actor_cumshot_type"
            v-bind:options="movieCreatorTranslations['actor_cumshot_type']"
          >
            {{ descriptionsTranslations["cumshot"] }} :
          </simple-labeled-select>
          <labeled-checkbox
            v-model="is_cumshot_compilation_type"
            class="movie-panel-checkbox"
            name="cumshot-compilation"
            >{{
              descriptionsTranslations["cumshot_compilation"]
            }}</labeled-checkbox>
        </fieldset>
        <fieldset class="panel-group">
          <legend class="panel-group-legend">
            {{ descriptionsTranslations["circumstances_and_style"] }}
          </legend>
          <simple-labeled-select
            v-model="location"
            v-bind:options="movieCreatorTranslations['location']"
          >
            {{ descriptionsTranslations["location"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="camera_style"
            v-bind:options="movieCreatorTranslations['camera_style']"
          >
            {{ descriptionsTranslations["camera_style"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="story_or_costume_type"
            v-bind:options="movieCreatorTranslations['story_or_costume_type']"
          >
            {{ descriptionsTranslations["story_or_costume_type"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="is_professional_production"
            v-bind:options="
              movieCreatorTranslations['is_professional_production']
            "
          >
            {{ descriptionsTranslations["movie_level"] }} :
          </simple-labeled-select>
          <simple-labeled-select
            v-model="has_story"
            v-bind:options="movieCreatorTranslations['binaryOptions']"
          >
            {{ descriptionsTranslations["has_story"] }} :
          </simple-labeled-select>
          <labeled-checkbox
            v-model="recorded_by_spy_camera"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["spy_camera"] }}</labeled-checkbox>
          <labeled-checkbox
            v-model="is_sadistic_or_masochistic"
            class="movie-panel-checkbox"
            >{{
              descriptionsTranslations["sadistic_or_masochistic"]
            }}</labeled-checkbox>
          <labeled-checkbox
            v-model="is_female_domination_type"
            class="movie-panel-checkbox"
            >{{
              descriptionsTranslations["female_domination"]
            }}</labeled-checkbox>
          <labeled-checkbox
            v-model="is_translated_to_polish"
            class="movie-panel-checkbox"
            >{{
              descriptionsTranslations["polish_language_version"]
            }}</labeled-checkbox>
        </fieldset>
        <fieldset class="panel-group">
          <legend class="panel-group-legend">
            {{ descriptionsTranslations["gadgets_and_clothing"] }}
          </legend>
          <labeled-checkbox
            v-model="actress_has_pantyhose"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["pantyhose"] }}</labeled-checkbox>
          <labeled-checkbox
            v-model="actress_has_stockings"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["stockings"] }}</labeled-checkbox>
          <labeled-checkbox
            v-model="actress_has_glasses"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["glasses"] }}</labeled-checkbox>
          <labeled-checkbox
            v-model="shows_high_heels"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["high_heels"] }}</labeled-checkbox
          >
          <labeled-checkbox
            v-model="shows_big_cock"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["huge_cock"] }}</labeled-checkbox
          >
          <labeled-checkbox
            v-model="shows_whips"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["whips"] }}</labeled-checkbox
          >
          <labeled-checkbox
            v-model="shows_sex_toys"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["sex_toys"] }}</labeled-checkbox
          >
          <labeled-checkbox
            v-model="shows_latex"
            class="movie-panel-checkbox"
            >{{ descriptionsTranslations["latex"] }}</labeled-checkbox
          >
        </fieldset>
        <fieldset class="panel-group--relative">
          <legend class="panel-group-legend">
            {{ descriptionsTranslations["stars"] }}
          </legend>
          <multiselect
            v-model="pornstars_list"
            v-bind:main-label="
              descriptionsTranslations['choose_from_pornstars_list']
            "
            v-bind:show-search-input="true"
          ></multiselect>
        </fieldset>
        <fieldset class="panel-group">
          <legend class="panel-group-legend">
            {{ descriptionsTranslations["movie_duration"] }}
          </legend>
          <input
            v-model="duration"
            class="movie-duration"
            step="1"
            type="time"
          />
        </fieldset>
        <fieldset class="panel-group">
          <legend class="panel-group-legend">
            {{ descriptionsTranslations["controls"] }}
          </legend>
          <reset-button
            v-on:click="resetPanel"
            class="control-panel-button--type-reset"
          >
            <shutdown-icon
              class="control-panel-button__icon--bigger"
            ></shutdown-icon>
            {{ descriptionsTranslations["reset_panel"] }}
          </reset-button>
          <accept-button v-on:click="saveMovie">
            {{ saveOrEditMovieButtonCaption }}
          </accept-button>
        </fieldset>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import SimpleLabeledSelect from "@jscomponents-form-controls/simple_labeled_select.vue";
import LabeledCheckbox from "@jscomponents/form_controls/labeled_checkbox.vue";
import ExpectCircle from "@jscomponents/decoration/expect_circle.vue";
import RelativeShadowContainer from "@jscomponents/decoration/relative_shadow_container.vue";
import Multiselect from "@jscomponents-form-controls/multiselect.vue";
import SimpleLabeledInput from "@jscomponents-form-controls/simple_labeled_input.vue";
import AcceptButton from "@jscomponents-form-controls/accept_button.vue";
import ShutdownIcon from "@svgicon/shutdown_icon.vue";
import ResetButton from "@jscomponents-form-controls/reset_button.vue";
import MovieCreatorTranslations from "@jsmodules/translations/movie_edit_create.js";
import DescriptionsTranslations from "@jsmodules/translations/movie_creator_descriptions.js";
import Translator from "@jsmodules/translator.js";
import EventEmmiter from "mitt";
import LabeledRange from "@jscomponents-form-controls/labeled_range";
import SearchEngineVariables from "@jsmodules/search_engine_variables.ts";
import UserNotification from "@jscomponents/user_notification.vue";
import PornstarBasic from "@interfaces/pornstars/pornstar_basic.ts";
import UserNotificationCalls from "@js/mixins/user_notification_call";

const EventBus = EventEmmiter();
const propertiesNotDescribingMovie = [
  "fetchingMoviesInProgress",
  "advancedSearchPanelIsVisible",
  "selectedOptionsVisibleForUser",
  "totalMoviesFound",
  "scrollYreactiveProperty",
  "currentPage",
  "movieCreatorTranslations",
  "csrfToken",
  "multiselectValues",
  "translator",
  "fetchingPornstarsInProgress",
  "descriptionsTranslations",
  "movieCreatorTranslations",
];

const propertiesToIgnoreDuringLoad = [
  "action_location_id",
  "created_at",
  "deleted_at",
  "story_or_costume_type_id",
  "actress_nationality_id",
];

const relationProperties = [
  "actress_nationality",
  "location",
  "story_or_costume_type",
];

const percentageProperties = [
  "anal_percentage",
  "blowjob_percentage",
  "handjob_percentage",
  "double_penetration_percentage",
  "pussy_fuck_percentage",
  "pussy_licking_percentage",
  "feet_petting_percentage",
  "position_69_percentage",
  "tittfuck_percentage",
];

export default {
  name: "movie-edit-create",

  emits : [
     'addedNewMovieCandidate',
     'updatedMovieCandidate'
  ],

  mixins: [UserNotificationCalls],

  components: {
    SimpleLabeledSelect,
    LabeledCheckbox,
    ExpectCircle,
    RelativeShadowContainer,
    Multiselect,
    SimpleLabeledInput,
    AcceptButton,
    ShutdownIcon,
    ResetButton,
    LabeledRange,
    UserNotification,
  },

  data() {
    return {
      movieCreatorTranslations: MovieCreatorTranslations,
      descriptionsTranslations: DescriptionsTranslations,
      csrfToken: undefined,
      multiselectValues: [],
      translator: Translator,
      fetchingPornstarsInProgress: true,
      abundance: "",
      actress_tits_size: "",
      actress_ass_size: "",
      actress_thickness: "",
      actress_age_range: "",
      actress_hair_color: "",
      actress_race: "",
      actress_nationality: "",
      shows_shaved_pussy: "",
      anal_percentage: 0,
      blowjob_percentage: 0,
      pussy_fuck_percentage: 0,
      handjob_percentage: 0,
      pussy_licking_percentage: 0,
      tittfuck_percentage: 0,
      feet_petting_percentage: 0,
      position_69_percentage: 0,
      double_penetration_percentage: 0,
      actor_cumshot_type: "",
      is_cumshot_compilation_type: false,
      location: "",
      camera_style: "",
      story_or_costume_type: "",
      is_professional_production: "",
      has_story: "",
      recorded_by_spy_camera: false,
      is_sadistic_or_masochistic: false,
      is_female_domination_type: false,
      is_translated_to_polish: false,
      actress_has_pantyhose: false,
      actress_has_stockings: false,
      actress_has_glasses: false,
      shows_high_heels: false,
      shows_big_cock: false,
      shows_latex: false,
      shows_whips: false,
      shows_sex_toys: false,
      pornstars_list: [],
      fetchingMoviesInProgress: false,
      advancedSearchPanelIsVisible: true,
      selectedOptionsVisibleForUser: [],
      totalMoviesFound: undefined,
      scrollYreactiveProperty: 0,
      currentPage: undefined,
      duration: "00:00:00",
      title: "",
      description: "",
      id: null,
    };
  },

  methods: {
    resetPanel(event): void {
      event.preventDefault();

      SearchEngineVariables["initialValueIsFalse"].forEach((propertyName) => {
        this[propertyName] = false;
      });

      this.anal_percentage = 0;
      this.blowjob_percentage = 0;
      this.pussy_fuck_percentage = 0;
      this.handjob_percentage = 0;
      this.pussy_licking_percentage = 0;
      this.feet_petting_percentage = 0;
      this.feet_petting_percentage = 0;
      this.position_69_percentage = 0;
      this.double_penetration_percentage = 0;

      this.pornstars_list = [];
      this.title = "";
      this.duration = "00:00:00";

      this.abundance = "";
      this.actress_tits_size = "";
      (this.actress_ass_size = ""), (this.actress_thickness = "");
      this.actress_age_range = "";
      this.actress_hair_color = "";
      this.actress_race = "";
      this.actress_nationality = "";
      this.shows_shaved_pussy = "";
      this.actor_cumshot_type = "";
      this.location = "";
      this.camera_style = "";
      this.story_or_costume_type = "";
      this.is_professional_production = "";
      this.has_story = "";
      this.description = "";
      this.id = null;
    },

    async fetchPornstarsList() {
      const requestData = {
        method: "GET",
        headers: {
          "X-CSRF-TOKEN": this.csrfToken,
        },
      };

      const response = await fetch("/pornstar", requestData);

      switch (response.status) {
        case 200:
          const responseBody = await response.json();
          this.loadPornstarsList(responseBody.data);
          break;

        default:
          this.showUserNotification(
            "error_during_fetching_pornstars_list",
            "error",
            true
          );
          break;
      }
    },

    loadPornstarsList(pornstars_list: PornstarBasic[]): void {
      let processedNames = [];
      pornstars_list.forEach((pornstarData) =>
        processedNames.push(pornstarData.nickname)
      );
      this.emitter.emit(
        "replaceAvailableOptionsForMultiselect",
        processedNames
      );
    },

    getMovieDataForRequest(): object {
      const movieData = { ...this.$data };
      propertiesNotDescribingMovie.forEach(
        (property) => delete movieData[property]
      );
      Object.keys(movieData).forEach(function (propertName: string) {
        if (!movieData[propertName]) {
          movieData[propertName] = null;
        }
      });

      if (this.pornstars_list.length === 0) {
        delete movieData.pornstars_list;
      }

      if (this.id === null) {
        delete movieData.id;
      }

      return movieData;
    },

    async processSaveMovieResponse(response) {
      let responseBody = await response.json();

      switch (response.status) {
        case 200:
           this.updateMovieCandidate(responseBody);
           this.showUserNotification("data_saved_successfully");
          break;
        case 201:
          this.showMovieCandidateOnList(responseBody);
          this.showUserNotification("data_saved_successfully");
          break;

        case 400:
          this.notifyEmployeeAboutBadRequest(responseBody);
          break;

        case 500:
          this.notifyEmployeeAboutServerError(response.body);
          break;
      }
    },

    showMovieCandidateOnList(movieCandidate: object): void {
      this.$emit("addedNewMovieCandidate", movieCandidate);
    },

    updateMovieCandidate(movieCandidate: object) : void {
       this.$emit('updatedMovieCandidate', movieCandidate);
    },

    async saveMovie() {
      const movieData = this.getMovieDataForRequest();
      const httpMethod = this.id ? "PUT" : "POST";

      const requestData = {
        method: httpMethod,
        body: JSON.stringify(movieData),
        headers: {
          "X-CSRF-TOKEN": this.csrfToken,
          "Content-type": "application/json; charset=UTF-8",
        },
      };

      const response = await fetch("/movie-candidate", requestData);
      this.processSaveMovieResponse(response);
    },

    addOnReadMovie(): void {
      this.emitter.on("loadMovieProperties", this.loadMovieProperties);
    },

    loadMovieProperties(movie: object[]): void {
      Object.keys(movie).forEach((movieProperty) => {
        if (!propertiesToIgnoreDuringLoad.includes(movieProperty)) {
          this.assignMovieProperty(movie, movieProperty);
        }
      });
    },

    assignMovieProperty(movie: object, movieProperty: string): void {
      const propertyValue = movie[movieProperty];

      switch (true) {
        case percentageProperties.includes(movieProperty):
          this[movieProperty] = Number(propertyValue);
          break;

        case relationProperties.includes(movieProperty):
          this[movieProperty] = propertyValue?.["name"];
          break;

        case movieProperty === "pornstars_list":
          this.pornstars_list = propertyValue ? propertyValue.split(",") : [];
          break;

        default:
          this[movieProperty] = propertyValue;
          break;
      }
    },
  },

  computed: {
    saveOrEditMovieButtonCaption(): string {
      return this.id
        ? `${this.descriptionsTranslations["save_changes_for_existing_movie"]}, id : ${this.id}`
        : this.descriptionsTranslations["add_new_movie"];
    },
  },

  mounted() {
    this.csrfToken = (<HTMLMetaElement>(
      document.getElementById("csrf-token")
    )).content;
    this.fetchPornstarsList();
    this.addOnReadMovie();
  },
};
</script>

<style lang="scss" scoped>
@import "~sasscomponent/movie_edit_create";
</style>