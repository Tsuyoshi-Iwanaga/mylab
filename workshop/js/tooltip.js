'use strict';
;(function($, undefined) {
  var Ctrl = (function () {

    var _func = {},

    _init = function () {
      _addjQuery();
    },

    //Add plugin to jQuery
    _addjQuery = function() {
      $.fn.tooltip = function(){
        var _ = this,
          opt = arguments[0],
          l = _.length,
          i;

        for (i=0; i<l; i++) {
          if(typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].tooltip = new _ToolTip(_[i], opt);
          }
        }
        return _;
      };
    },

    //Constructer
    _ToolTip = function(element, options) {
      var _ = this;

      _.$el = $(element);

      _.initials = {
        $balloon: $('<div class="p-toolTipBalloon"></div>'),
        activeClass: 'is-active',
      }
      _.settings = $.extend({}, _.initials, options);

     _.fire();
    },

    // public
    _func = {
      init: _init
    };

    _ToolTip.prototype.fire = function() {
      var _ = this;

      _.bindEvents();
      _.settings.$balloon.appendTo('body');
    };

    _ToolTip.prototype.bindEvents = function() {
      var _ = this;

      _.$el.on('mouseenter', function(ev){
        //_.showBalloon($(ev.target).data('tooltiptext')); jQuery
        _.showBalloon(ev.target.dataset.tooltiptext);
      });

      _.$el.on('mouseleave', function(ev){
        _.hideBalloon();
      });

      _.$el.on('mousemove', function(ev){
        _.moveBallon(ev.pageX, ev.pageY);
      });
    };

    _ToolTip.prototype.showBalloon = function (text) {
      var _ = this;
      _.settings.$balloon.text(text);
      _.settings.$balloon.addClass(_.settings.activeClass);

    }

    _ToolTip.prototype.hideBalloon = function ($el) {
      var _ = this;
      _.settings.$balloon.removeClass(_.settings.activeClass);
    }

    _ToolTip.prototype.moveBallon = function (x, y) {
      var _ = this;
      _.settings.$balloon.css({left: Number(x + 20), top: y});
    }

    return _func;

  }());

  $(function () {
    Ctrl.init();
  });

}(jQuery));
