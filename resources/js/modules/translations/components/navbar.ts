import Translator from '@jsmodules/translator.js';

const translations : {
    showContentSideBarButtonTitle : string,
    showContentSideBarButtonCaption : string,
    showAuthenticatedUserSideBarTitle : string,
    showAuthenticatedUserSidebarCaption : string,
    userAvatarDescription : string,
    register : string,
    movies : string,
    categories : string,
    the_latest : string,
    the_most_popular : string,
    advanced_search : string,
    pornstars_navbar_caption : string,
    default_avatar : string,
    user_avatar_description : string
    dictionary : string
    
} = {
    showContentSideBarButtonTitle : Translator.translate('show_content_side_bar_title'),
    showContentSideBarButtonCaption : Translator.translate('show_content_side_bar_caption'),
    showAuthenticatedUserSideBarTitle : Translator.translate('show_authenticated_user_sidebar_title'),
    showAuthenticatedUserSidebarCaption : Translator.translate('show_authenticated_user_sidebar_caption'),
    userAvatarDescription : Translator.translate('user_avatar_description'),
    register : Translator.translate('register'),
    movies : Translator.translate('movies'),
    categories : Translator.translate('categories'),
    the_latest : Translator.translate('the_latest'),
    the_most_popular : Translator.translate('the_most_popular'),
    advanced_search : Translator.translate('advanced_search'),
    pornstars_navbar_caption : Translator.translate('pornstars_navbar_caption'),
    default_avatar : Translator.translate('default_avatar'),
    user_avatar_description : Translator.translate('user_avatar_description'),
    dictionary : Translator.translate('dictionary'),
};

export default translations;