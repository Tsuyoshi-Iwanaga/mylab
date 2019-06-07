'use strict';
;(function($, undefined) {
  var Ctrl = (function () {

    var _func = {},

    _init = function () {
      _addjQuery();
    },

    //Add plugin to jQuery
    _addjQuery = function() {
      $.fn.switchImage = function(){
        var _ = this,
          opt = arguments[0],
          l = _.length,
          i;

        for (i=0; i<l; i++) {
          if(typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].switchImage = new _SwitchImage(_[i], opt);
          }
        }
        return _;
      };
    },

    //Constructer
    _SwitchImage = function(element, options) {
      var _ = this;

      _.$el = $(element);

      _.initials = {
        mainImg : _.$el.find('.js-switchImage_main'),
        subImg : _.$el.find('.js-switchImage_sub'),
        activeClass: 'is-active',
        triggerEvent: 'click',
        index: 0
      }
      _.settings = $.extend({}, _.initials, options);

     _.fire();
    },

    // public
    _func = {
      init: _init
    };

    _SwitchImage.prototype.fire = function() {
      var _ = this;

      _.bindEvents();
      _.build();
    },

    _SwitchImage.prototype.build = function() {
      var _ = this;
      var mainImgPath = _.settings.subImg.children().eq(_.settings.index).find('img').attr('src');

      _.settings.mainImg.append(`<img src="${mainImgPath}">`);
    },

    _SwitchImage.prototype.bindEvents = function() {
      var _ = this;

      _.settings.subImg.children().on(_.settings.triggerEvent, function() {
        var mainImgPath = $(this).find('img').attr('src');
        _.settings.mainImg.find('img').attr('src', mainImgPath);

        _.settings.subImg.children().removeClass(_.settings.activeClass);
        $(this).addClass(_.settings.activeClass);
      });
    };

    return _func;

  }());

  $(function () {
    Ctrl.init();
  });

}(jQuery));
