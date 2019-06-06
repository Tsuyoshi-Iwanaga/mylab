'use strict';
;(function($, undefined) {
  var Ctrl = (function () {

    var _func = {},

    _init = function () {
      _addjQuery();
    },

    //Add plugin to jQuery
    _addjQuery = function() {
      $.fn.navigation = function(){
        var _ = this,
          opt = arguments[0],
          l = _.length,
          i;

        for (i=0; i<l; i++) {
          if(typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].navigation = new _Navigation(_[i], opt);
          }
        }
        return _;
      };
    },

    //Constructer
    _Navigation = function(element, options) {
      var _ = this;

      _.$el = $(element);

      _.initials = {
        heads : $('.js-navHead'),
        contents : $('.js-navContent'),
        headsClassName : 'js-navHead',
        contentsClassName : 'js-navContent',
        activeClass: 'is-active'
      }
      _.settings = $.extend({}, _.initials, options);

     _.fire();
    },

    // public
    _func = {
      init: _init
    };

    _Navigation.prototype.fire = function() {
      var _ = this;

      _.attachCurrnet();
      _.bindEvents();
      _.settings.contents.slideUp();
    };

    _Navigation.prototype.bindEvents = function() {
      var _ = this;

      _.settings.heads.on('mouseenter', function(ev) {
        $(this).children('.' + _.settings.contentsClassName).slideDown();
      });

      _.settings.heads.on('mouseleave', function(ev) {
        $(this).children('.' + _.settings.contentsClassName).slideUp();
      });
    },

    _Navigation.prototype.attachCurrnet = function() {
      var _ = this;
      var queryArr = location.search.replace(/\?/, '').split('&');
      var categoryNum;

      queryArr.forEach(function(v) {
        if(v.match(/category=/)) {
          categoryNum = Number(v.replace(/category=/, ''));
        }
      });

      _.settings.heads.eq(categoryNum - 1).parent().addClass(_.settings.activeClass);
    };

    return _func;

  }());

  $(function () {
    Ctrl.init();
  });
}(jQuery));
