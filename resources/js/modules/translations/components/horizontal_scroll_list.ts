import Translator from '@jsmodules/translator.js';

const translations : {
    scrollLeft : string,
    scrollRight : string,
} = {
    scrollLeft : Translator.translate('scroll_movies_list_left'),
    scrollRight : Translator.translate('scroll_movies_list_right'),
}

export default translations;