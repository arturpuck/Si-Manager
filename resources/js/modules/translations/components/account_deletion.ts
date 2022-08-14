import Translator from '@jsmodules/translator.js';

const translations : {
    accountDeletionWarning : string,
    delete : string,
    cancel : string,
    password : string
   
} = {
    accountDeletionWarning : Translator.translate('account_deletion_warning'),
    delete : Translator.translate('delete'),
    cancel : Translator.translate('cancel'),
    password : Translator.translate('password'),
}

export default translations;