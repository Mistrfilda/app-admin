declare global {
    interface Window {
        frontMenu: any;
        dropdown: any;
        Alpine: any;
    }
}

//styles
import './scss/index.scss';

//scripts
import naja from "naja";

import './js/LiveFormValidation';

import './ts/alpine/AppAlpine';