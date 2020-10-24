'use strict';
;(function($, undefined) {
  var Ctrl = (function () {

    var _func = {},

    _init = function () {
      _addjQuery();
    },

    //Add plugin to jQuery
    _addjQuery = function() {
      $.fn.modal = function(){
        var _ = this,
          opt = arguments[0],
          l = _.length,
          i;

        for (i=0; i<l; i++) {
          if(typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].modal = new _Modal(_[i], opt);
          }
        }
        return _;
      };
    },

    //Constructer
    _Modal = function(element, options) {
      var _ = this;

      _.$el = $(element);

      _.initials = {
        trigger : _.$el,
        target : $(_.$el.data('modal')),
        closeBtn : $('.js-modalClose'),
        overLayClass: 'js-overlay',
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

    _Modal.prototype.fire = function() {
      var _ = this;

      _.generateCover();
      _.settings.target.hide();
      _.hideModal();
      _.placeTarget();
      _.bindEvents();
    };

    _Modal.prototype.bindEvents = function() {
      var _ = this;

      _.settings.trigger.on('click', function(ev) {
        ev.preventDefault();
        _.showModal();
      });

      _.settings.closeBtn.on('click', function(ev) {
        _.hideModal();
      });

      $('body').on('click', function(ev) {
        if(ev.target.classList.contains(_.settings.overLayClass)) {
          _.hideModal();
        }
      });
    };

    _Modal.prototype.placeTarget = function() {
      var _ = this;

      _.settings.target.css({
        position: "fixed",
        top: "50%",
        left: "50%",
        margin: "auto",
        transform: "translate(-50%, -50%)",
        transition: _.settings.targetTransition,
      });
    }

    _Modal.prototype.hideModal = function() {
      var _ = this;

      _.settings.target.hide();
      _.settings.target.animate({opacity: 0});

      $('.' + _.settings.overLayClass).hide();
    };

    _Modal.prototype.showModal = function() {
      var _ = this;

      _.settings.target.show();
      _.settings.target.animate({opacity: 1});

      $('.' + _.settings.overLayClass).show();
    };

    _Modal.prototype.generateCover = function() {
      var _ = this;

      _.settings.target.css({ zIndex: `${_.settings.zIndex}` });

      if(!$('.' + _.settings.overLayClass)[0]) {
        $('body').append(`<div class="p-overlay ${_.settings.overLayClass}" style="z-index: ${_.settings.zIndex - 1}; background-color: ${_.settings.overLayBG}; opacity: ${_.settings.overLayOpacity}; position: fixed; top: 0; left: 0; width: 100%; height: 120vh;"></div>`);
      }
    };

    _Modal.prototype.swichMenu = function(is_open) {
      var _ = this;

      if(is_open) {
        _.showModal();
      } else {
        _.hideModal();
      }
    };

    return _func;

  }());

  $(function () {
    Ctrl.init();
  });
}(jQuery));
