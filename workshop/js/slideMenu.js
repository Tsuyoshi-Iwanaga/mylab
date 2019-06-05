'use strict';
;(function($, undefined) {
  var Ctrl = (function () {

    var _func = {},

    _init = function () {
      _addjQuery();
    },

    //Add plugin to jQuery
    _addjQuery = function() {
      $.fn.slideMenu = function(){
        var _ = this,
          opt = arguments[0],
          l = _.length,
          i;

        for (i=0; i<l; i++) {
          if(typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].slideMenu = new _SlideMenu(_[i], opt);
          }
        }
        return _;
      };
    },

    //Constructer
    _SlideMenu = function(element, options) {
      var _ = this;

      _.$el = $(element);

      _.initials = {
        trigger : _.$el,
        target : $(_.$el.data('target')),
        activeClass: 'is-active',
        overLayClass: 'js-overlay',
        fromDirection: 'left',
        targetTransition: 'all 0.5s ease',
        overLayBG: '#000',
        overLayOpacity: 0.8,
        zIndex: 10
      }
      _.settings = $.extend({}, _.initials, options);

     _.fire();
    },

    // public
    _func = {
      init: _init
    };

    _SlideMenu.prototype.fire = function() {
      var _ = this;

      _.generateCover();
      _.settings.target.hide();
      _.hideSlide();
      _.placeTarget();
      _.bindEvents();
    };

    _SlideMenu.prototype.bindEvents = function() {
      var _ = this;

      _.settings.trigger.on('click', function(ev) {
        if(this.classList.contains(_.settings.activeClass)) {
          this.classList.remove(_.settings.activeClass);
          _.swichMenu(false);
        } else {
          this.classList.add(_.settings.activeClass);
          _.swichMenu(true);
        }
      });

      $('body').on('click', function(ev) {
        if(ev.target.classList.contains(_.settings.overLayClass)) {
          _.hideSlide();
          _.settings.trigger[0].classList.remove(_.settings.activeClass);
        }
      });
    };

    _SlideMenu.prototype.placeTarget = function() {
      var _ = this;

      if(_.settings.fromDirection === 'left') {
        _.settings.target.css({
          top: 0,
          left: 0
        });
      } else if(_.settings.fromDirection === 'right') {
        _.settings.target.css({
          top: 0,
          right: 0
        });
      }

      _.settings.target.css({
        position: "fixed",
        transition: _.settings.targetTransition,
      });
    }

    _SlideMenu.prototype.hideSlide = function() {
      var _ = this;

      if(_.settings.fromDirection === 'right') {
        _.settings.target.css({transform: 'translateX(100%)'});
      } else if (_.settings.fromDirection === 'left') {
        _.settings.target.css({transform: 'translateX(-100%)'});
      }

      $('.' + _.settings.overLayClass).hide();
    };

    _SlideMenu.prototype.showSlide = function() {
      var _ = this;

      _.settings.target.show();

      _.settings.target.css({transform: 'translateX(0)'});

      $('.' + _.settings.overLayClass).show();
    };

    _SlideMenu.prototype.generateCover = function() {
      var _ = this;

      _.settings.target.css({ zIndex: `${_.settings.zIndex}` });

      if(!$('.' + _.settings.overLayClass)[0]) {
        $('body').append(`<div class="p-overlay ${_.settings.overLayClass}" style="z-index: ${_.settings.zIndex - 1}; background-color: ${_.settings.overLayBG}; opacity: ${_.settings.overLayOpacity}; position: fixed; top: 0; left: 0; width: 100%; height: 120vh;"></div>`);
      }
    };

    _SlideMenu.prototype.swichMenu = function(is_open) {
      var _ = this;

      if(is_open) {
        _.showSlide();
      } else {
        _.hideSlide();
      }
    };

    return _func;

  }());

  $(function () {
    Ctrl.init();
  });
}(jQuery));
