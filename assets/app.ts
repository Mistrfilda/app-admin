declare global {
    interface Window {
        frontMenu: any;
        dropdown: any;
        Alpine: any;
        flashMessage: any;
    }
}

//styles
import './scss/index.scss';

//scripts
import naja from 'naja';
naja.initialize();

import './js/LiveFormValidation';

import './ts/alpine/AppAlpine';