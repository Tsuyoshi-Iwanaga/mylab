'use strict';
;(function($, undefined) {
  var Ctrl = (function () {

    var _func = {},

    _init = function () {
      _addjQuery();
    },

    //Add plugin to jQuery
    _addjQuery = function() {
      $.fn.tab = function(){
        var _ = this,
          opt = arguments[0],
          l = _.length,
          i;

        for (i=0; i<l; i++) {
          if(typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].tab = new _Tab(_[i], opt);
          }
        }
        return _;
      };
    },

    //Constructer
    _Tab = function(element, options) {
      var _ = this;

      _.$el = $(element);

      _.initials = {
        heads : _.$el.children('.js-tabHead').children(),
        contents : _.$el.children('.js-tabContent').children(),
        activeClass: 'is-active',
        index: 0
      }
      _.settings = $.extend({}, _.initials, options);

     _.fire();
    },

    // public
    _func = {
      init: _init
    };

    _Tab.prototype.fire = function() {
      var _ = this;

      _.bindEvents();
      _.settings.contents.hide();
      _.tabSwitch(_.settings.index);
    };

    _Tab.prototype.bindEvents = function() {
      var _ = this;

      _.settings.heads.on('click', function (ev) {
        ev.preventDefault();
        _.settings.index = _.settings.heads.index(this);
        _.tabSwitch(_.settings.index);
      });
    };

    _Tab.prototype.tabSwitch = function (index) {
      var _ = this;

      _.settings.heads.removeClass(_.settings.activeClass);
      _.settings.contents.removeClass(_.settings.activeClass);

      _.settings.heads.eq(index).addClass(_.settings.activeClass);
      _.settings.contents.eq(index).addClass(_.settings.activeClass);
    }

    return _func;

  }());

  $(function () {
    Ctrl.init();
  });

}(jQuery));
