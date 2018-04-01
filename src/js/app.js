/**
 * GLOBAL REQS
 * Include the required libs from the window (see package.json for more)
 */
import $ from 'jquery';
/**
 * MODULE REQS
 */
//es6 style
import emitter from './modules/emitter.js';
import utils from './modules/utils.js';
import sliders from './modules/sliders.js';

/**
 * MAIN DOM READY EVENT
 */
jQuery(document).ready(function($) {
    /**
     * INIT MODULES
     * Calls the basic setup/init functions on each module.
     * How are we going to structure this?
     */

    emitter.emit('dom:loaded');

    $('body').addClass(utils.isTouch() ? 'is-touch' : 'no-touch');
});
