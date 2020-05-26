/**
 * @file
 * Global utilities.
 *
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.barrio_custom = {
    attach: function (context, settings) {
        alert("I am an alert box!");
    }
  };

})(jQuery, Drupal);
