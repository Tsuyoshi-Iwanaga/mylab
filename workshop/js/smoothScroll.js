'use strict';
;(function($, undefined) {
  var Ctrl = (function () {

    var _func = {},
        disabledClass = '.js-notScroll',

    _init = function () {
      _bindEvents ();
    },

    _bindEvents = function () {
      $('a[href^="#"]:not(' + disabledClass + ')').on('click', function (e) {
        e.preventDefault();
        _move($(this));
      });
    },

    _move = function ($el, speed) {
      var offset = 0,
          speed = 500;

      if($el.attr('href') !== '#') {
        offset = $($el.attr('href')).offset().top
      }

      $('html, body').animate({ scrollTop: offset }, speed, 'swing');
    },

    // public
    _func = {
      init: _init
    };

    return _func;
  }());

  $(function () {
    Ctrl.init();
  });
}(jQuery));
