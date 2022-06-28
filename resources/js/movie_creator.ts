import { createApp } from 'vue';
import SimpleLabeledSelect from '@jscomponents-form-controls/simple_labeled_select.vue';
import LabeledCheckbox from '@jscomponents/form_controls/labeled_checkbox.vue';
import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue';
import Multiselect from '@jscomponents-form-controls/multiselect.vue';
import SimpleLabeledInput from '@jscomponents-form-controls/simple_labeled_input.vue';
import AcceptButton from '@jscomponents-form-controls/accept_button.vue';
import ShutdownIcon from "@svgicon/shutdown_icon.vue";
import ResetButton from '@jscomponents-form-controls/reset_button.vue';
import MovieCreatorTranslations from '@jsmodules/translations/movie_edit_create.js';
import Translator from '@jsmodules/translator.js';
import EventEmmiter from 'mitt';
import LabeledRange from "@jscomponents-form-controls/labeled_range";
import SearchEngineVariables from '@jsmodules/search_engine_variables.ts';
import UserNotification from '@jscomponents/user_notification.vue';
import NotificationFunction from '@jsmodules/notification_function.ts';
import MovieEditCreate from '@jscomponents/movie_edit_create';

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

const settings = {

 components : {
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
   MovieEditCreate
 },

  data() {
     return {
        movieCreatorTranslations: MovieCreatorTranslations,
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

const app = createApp(settings);
app.config.globalProperties.emitter = EventBus;
      
app.mount("#app");
