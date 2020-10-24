'use strict';
;(function($, undefined) {
  var Ctrl = (function () {

    var _func = {},

    _init = function () {
      _addjQuery();
    },

    //Add plugin to jQuery
    _addjQuery = function() {
      $.fn.accordion = function(){
        var _ = this,
          opt = arguments[0],
          l = _.length,
          i;

        for (i=0; i<l; i++) {
          if(typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].accordion = new _Accordion(_[i], opt);
          }
        }
        return _;
      };
    },

    //Constructer
    _Accordion = function(element, options) {
      var _ = this;

      _.$el = $(element);

      _.initials = {
        heads : _.$el.children('.js-accTitle'),
        contents : _.$el.children('.js-accContent'),
        activeClass: 'is-active',
        allClose: false,
        index: 0
      }
      _.settings = $.extend({}, _.initials, options);

     _.fire();
    },

    // public
    _func = {
      init: _init
    };

    _Accordion.prototype.fire = function() {
      var _ = this;

      _.bindEvents();
      _.settings.contents.hide();
    };

    _Accordion.prototype.bindEvents = function() {
      var _ = this;

      _.settings.heads.on('click', function (ev) {
        ev.preventDefault();

        _.accordionOperation($(this));
      });
    };

    _Accordion.prototype.accordionOperation = function ($el) {
      var _ = this;

      if(_.settings.allClose && !$el.hasClass(_.settings.activeClass)) {
        _.settings.contents.slideUp(200);
        _.settings.heads.removeClass(_.settings.activeClass);
      }

      if(!$el.hasClass(_.settings.activeClass)) {
        $el.next().slideDown(200);
        $el.addClass(_.settings.activeClass);
      } else {
        $el.next().slideUp(200);
        $el.removeClass(_.settings.activeClass);
      }
    }

    return _func;

  }());

  $(function () {
    Ctrl.init();
  });

}(jQuery));
