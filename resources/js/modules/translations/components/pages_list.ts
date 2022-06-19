import Translator from '@jsmodules/translator.js';

const descriptions : {
    previousLinksDescription : string,
    nextLinksDescription : string,
    previous_page : string,
    next_page : string,
    first_page : string,
    last_page : string,
    further : string,
    back : string,
    up : string
} = {
    previousLinksDescription : Translator.translate('scroll_previous_links'),
    nextLinksDescription : Translator.translate('scroll_next_links'),
    previous_page : Translator.translate('previous_page'),
    last_page : Translator.translate('last_page'),
    next_page : Translator.translate('next_page'),
    first_page : Translator.translate('first_page'),
    further : Translator.translate('further'),
    back : Translator.translate('back'),
    up : Translator.translate('up')
};

export default descriptions;