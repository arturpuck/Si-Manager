<template>
<form>
      <simple-labeled-input class="movie-title" v-model="title">{{descriptionsTranslations['title']}} : </simple-labeled-input>
      <div class="add-movie-panel">
         <fieldset class="panel-group">
            <legend class="panel-group-legend">
               {{descriptionsTranslations['actress_body_and_type']}}
            </legend>
            <simple-labeled-select v-model="titsSize" v-bind:options="movieCreatorTranslations['titsSize']">
               {{descriptionsTranslations['tits_size']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="assSize" v-bind:options="movieCreatorTranslations['assSize']">
               {{descriptionsTranslations['ass_size']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="thicknessSize" v-bind:options="movieCreatorTranslations['thicknessSize']">
               {{descriptionsTranslations['thickness']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="ageRange" v-bind:options="movieCreatorTranslations['ageRange']">
               {{descriptionsTranslations['age']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="hairColor" v-bind:options="movieCreatorTranslations['hairColor']">
               {{descriptionsTranslations['hair_color']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="race" v-bind:options="movieCreatorTranslations['race']">
               {{descriptionsTranslations['race']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="nationality" v-bind:options="movieCreatorTranslations['nationality']">
               {{descriptionsTranslations['nationality']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="shavedPussy" v-bind:options="movieCreatorTranslations['binaryOptions']">
               {{descriptionsTranslations['shaved_pussy']}} :
            </simple-labeled-select>
         </fieldset>
         <fieldset class="panel-group">
            <legend class="panel-group-legend">
               {{descriptionsTranslations['sex_type']}}
            </legend>
            <simple-labeled-select v-model="abundanceType" v-bind:options="movieCreatorTranslations['abundanceType']">
               {{descriptionsTranslations['abundance']}} :
            </simple-labeled-select>
            <labeled-range class="sex-ammount" v-model="analAmount" unit="%">{{descriptionsTranslations['anal']}}</labeled-range>
            <labeled-range class="sex-ammount" v-model="blowjobAmount" unit="%">{{descriptionsTranslations['blowjob']}}</labeled-range>
            <labeled-range class="sex-ammount" v-model="vaginalAmount" unit="%">{{descriptionsTranslations['vaginal']}}</labeled-range>
            <labeled-range class="sex-ammount" v-model="handjobAmount" unit="%">{{descriptionsTranslations['handjob']}}</labeled-range>
            <labeled-range class="sex-ammount" v-model="pussyLickingAmount" unit="%">{{descriptionsTranslations['pussy_licking']}}</labeled-range>
            <labeled-range class="sex-ammount" v-model="titfuckAmount" unit="%">{{descriptionsTranslations['tittfuck']}}</labeled-range>
            <labeled-range class="sex-ammount" v-model="feetPettingAmount" unit="%">{{descriptionsTranslations['feet']}}</labeled-range>
            <labeled-range class="sex-ammount" v-model="doublePenetrationAmount" unit="%">{{descriptionsTranslations['double_penetration']}}</labeled-range>
            <labeled-range class="sex-ammount" v-model="position69amount" unit="%">{{descriptionsTranslations['position_69']}}</labeled-range>
         
            <simple-labeled-select v-model="cumshotType" v-bind:options="movieCreatorTranslations['cumshotType']">
               {{descriptionsTranslations['cumshot']}} :
            </simple-labeled-select>
            <labeled-checkbox v-model="isCumshotCompilation" name="cumshot-compilation">{{descriptionsTranslations['cumshot_compilation']}}</labeled-checkbox>
         </fieldset>
         <fieldset class="panel-group">
            <legend class="panel-group-legend">
               {{descriptionsTranslations['circumstances_and_style']}}
            </legend>
            <simple-labeled-select v-model="location" v-bind:options="movieCreatorTranslations['location']">
               {{descriptionsTranslations['location']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="cameraStyle" v-bind:options="movieCreatorTranslations['cameraStyle']">
               {{descriptionsTranslations['camera_style']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="storyOrCostume" v-bind:options="movieCreatorTranslations['storyOrCostume']">
               {{descriptionsTranslations['story_or_costume_type']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="professionalismLevel" v-bind:options="movieCreatorTranslations['professionalismLevel']">
               {{descriptionsTranslations['movie_level']}} :
            </simple-labeled-select>
            <simple-labeled-select v-model="hasStory" v-bind:options="movieCreatorTranslations['binaryOptions']">
               {{descriptionsTranslations['has_story']}} :
            </simple-labeled-select>
            <labeled-checkbox v-model="recordedBySpyCamera" class="labeled_checkbox--aditional-margin" name="recorded-by-spy-camera">{{descriptionsTranslations['spy_camera']}}</labeled-checkbox>
            <labeled-checkbox v-model="isSadisticOrMasochistic" class="labeled_checkbox--aditional-margin" name="sado-maso">{{descriptionsTranslations['sadistic_or_masochistic']}}</labeled-checkbox>
            <labeled-checkbox v-model="isFemaleDomination" class="labeled_checkbox--aditional-margin" name="female-domination">{{descriptionsTranslations['female_domination']}}</labeled-checkbox>
            <labeled-checkbox v-model="isTranslatedToPolish" class="labeled_checkbox--aditional-margin" name="translated-to-polish">{{descriptionsTranslations['polish_language_version']}}</labeled-checkbox>
         </fieldset>
         <fieldset class="panel-group">
            <legend class="panel-group-legend">
               {{descriptionsTranslations['gadgets']}}
            </legend>
            <labeled-checkbox v-model="showPantyhose" class="labeled_checkbox--aditional-margin" name="pantyhose">{{descriptionsTranslations['pantyhose']}}</labeled-checkbox>
            <labeled-checkbox v-model="showStockings" class="labeled_checkbox--aditional-margin" name="stockings">{{descriptionsTranslations['stockings']}}</labeled-checkbox>
            <labeled-checkbox v-model="showGlasses" class="labeled_checkbox--aditional-margin" name="glasses">{{descriptionsTranslations['glasses']}}</labeled-checkbox>
            <labeled-checkbox v-model="showHighHeels" class="labeled_checkbox--aditional-margin" name="high-heels">{{descriptionsTranslations['high_heels']}}</labeled-checkbox>
            <labeled-checkbox v-model="showHugeCock" class="labeled_checkbox--aditional-margin" name="huge-cock">{{descriptionsTranslations['huge_cock']}}</labeled-checkbox>
            <labeled-checkbox v-model="showWhips" class="labeled_checkbox--aditional-margin" name="whips">{{descriptionsTranslations['whips']}}</labeled-checkbox>
            <labeled-checkbox v-model="showSexToys" class="labeled_checkbox--aditional-margin" name="sex-toys">{{descriptionsTranslations['sex_toys']}}</labeled-checkbox>
         </fieldset>
         <fieldset class="panel-group--relative">
            <legend class="panel-group-legend">
               {{descriptionsTranslations['stars']}}
            </legend>
            <multiselect v-bind:options="pornstarsNames" v-model="pornstarsList" main-label="descriptionsTranslations['choose_from_pornstars_list']" v-bind:show-search-input="true"></multiselect>
         </fieldset>
         <fieldset class="panel-group">
            <legend class="panel-group-legend">
               {{descriptionsTranslations['movie_duration']}}
            </legend>
            <input v-model="movieDuration" class="movie-duration" step="1" type="time">
            
         </fieldset>
         <fieldset class="panel-group">
            <legend class="panel-group-legend">
               {{descriptionsTranslations['controls']}}
            </legend>
            <reset-button v-on:click="resetPanel" class="control-panel-button--type-reset">
               <shutdown-icon class="control-panel-button__icon--bigger"></shutdown-icon>
               {{descriptionsTranslations['reset_panel']}}
            </reset-button>
            <accept-button v-on:click="saveMovie">
               {{descriptionsTranslations['save_movie']}}
            </accept-button>
         </fieldset>
      </div>
   </form>
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
import DescriptionsTranslations from "@jsmodules/translations/movie_creator_descriptions.js"
import Translator from "@jsmodules/translator.js";
import EventEmmiter from "mitt";
import LabeledRange from "@jscomponents-form-controls/labeled_range";
import SearchEngineVariables from "@jsmodules/search_engine_variables.ts";
import UserNotification from "@jscomponents/user_notification.vue";
import NotificationFunction from "@jsmodules/notification_function.ts";

const EventBus = EventEmmiter();
const propertiesNotDescribingMovie = [
   'fetchingMoviesInProgress',
   'advancedSearchPanelIsVisible',
   'selectedOptionsVisibleForUser',
   'totalMoviesFound',
   'scrollYreactiveProperty',
   'currentPage',
   'movieCreatorTranslations',
   'csrfToken',
   'multiselectValues',
   'translator',
   'fetchingPornstarsInProgress'
];

export default {
  name: "movie-edit-create",

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
        descriptionsTranslations : DescriptionsTranslations,
        csrfToken: undefined,
        multiselectValues: [],
        translator: Translator,
        fetchingPornstarsInProgress: true,
        abundanceType: "",
        titsSize: "",
        assSize: "",
        thicknessSize: "",
        ageRange: "",
        hairColor: "",
        race: "",
        nationality: "",
        shavedPussy: "",
        analAmount: 0,
        blowjobAmount: 0,
        vaginalAmount: 0,
        handjobAmount: 0,
        pussyLickingAmount: 0,
        titfuckAmount: 0,
        feetPettingAmount: 0,
        position69amount: 0,
        doublePenetrationAmount: 0,
        cumshotType: "",
        isCumshotCompilation: false,
        location: "",
        cameraStyle: "",
        storyOrCostume: "",
        professionalismLevel: "",
        hasStory: "",
        recordedBySpyCamera: false,
        isSadisticOrMasochistic: false,
        isFemaleDomination: false,
        isTranslatedToPolish: false,
        showPantyhose: false,
        showStockings: false,
        showGlasses: false,
        showHighHeels: false,
        showHugeCock: false,
        showWhips: false,
        showSexToys: false,
        pornstarsList: [],
        fetchingMoviesInProgress: false,
        advancedSearchPanelIsVisible: true,
        selectedOptionsVisibleForUser: [],
        totalMoviesFound: undefined,
        scrollYreactiveProperty: 0,
        currentPage: undefined,
        movieDuration : '00:00:00',
        title : ''
     };
  },

  methods: {

    resetPanel(event): void {

      event.preventDefault();

      SearchEngineVariables['initialValueIsFalse'].forEach(propertyName => {
        this[propertyName] = false;
      });

      this.analAmount = 0;
      this.blowjobAmount = 0;
      this.vaginalAmount = 0;
      this.handjobAmount = 0;
      this.pussyLickingAmount = 0;
      this.titfuckAmount = 0;
      this.feetPettingAmount = 0;
      this.position69amount = 0;
      this.doublePenetrationAmount = 0;


      this.pornstarsList = [];
      this.title = '';
      this.movieDuration = '00:00:00';

      this.abundanceType = '';
      this.titsSize = '';
      this.assSize = '',
      this.thicknessSize = '';
      this.ageRange = '';
      this.hairColor = '';
      this.race = '';
      this.nationality = '';
      this.shavedPussy = '';
      this.cumshotType = '';
      this.location = '';
      this.cameraStyle = '';
      this.storyOrCostume = '';
      this.professionalismLevel = '';
      this.hasStory = '';
    },

   async saveMovie() {
        const movieData = {...this.$data};
        propertiesNotDescribingMovie.forEach( property => delete movieData[property] );
        Object.keys(movieData).forEach(function(propertName : string){
           if(!movieData[propertName]) {
             delete movieData[propertName];
           }
        })

        if(this.pornstarsList.length === 0) {
          delete movieData.pornstarsList;
        }

        const requestData = {
         method: 'POST',
         body: JSON.stringify(movieData),
         headers: {
           'X-CSRF-TOKEN': this.csrfToken,
           'Content-type': 'application/json; charset=UTF-8'
         }
       };

       const response = await fetch('/employee-panel/movies', requestData);

       switch(response.status) {
           case 201:
             this.notifyEmployee('added_movie');
           break;

           case 400:
              let responseBody = await response.json();
              this.notifyEmployeeAboutBadRequest(responseBody)
              break;
              
            case 500:
              console.log(response.body);
              this.notifyEmployeeAboutServerError(response.body);
              break;
       }


    },

    notifyEmployeeAboutBadRequest(responseBody) : void {
         let errorMessage = Translator.translate('employee_added_incorrect_parameters');
         errorMessage= `${errorMessage} : ${responseBody.join(', ')}`;
         this.notifyEmployee(errorMessage, 'error');
    },
        
    notifyEmployeeAboutServerError(response) : void {
          let errorMessage = Translator.translate('the_requested_data_is_probably_ok_but_a_server_error_occured');
          errorMessage= `${errorMessage} : ${response}`;
          this.notifyEmployee(errorMessage, 'error');
    },

    notifyEmployee : NotificationFunction

  },

  mounted() {
    this.csrfToken = (<HTMLMetaElement>document.getElementById("csrf-token")).content;
  } 
};
</script>

<style lang="scss">
@import '~sasscomponent/movie_edit_create';
</style>