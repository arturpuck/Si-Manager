import Translator from '@jsmodules/translator.js';

const translations : {
    views : string,
    preview : string,
    movieTranslatedToPolish : string
} = {
     views : Translator.translate('views'),
     preview : Translator.translate('preview'),
     movieTranslatedToPolish : Translator.translate('movie_translated_to_polish'),
}

export default translations;