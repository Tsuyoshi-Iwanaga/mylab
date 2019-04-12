;(function ($){
  'use strict';

  var Calselector = window.Calselector || {};

  Calselector = (function() {

    var _Calselector = function(elem, settings) {
      var _ = this, dataSettings;
      
      _.defaults = {
        month: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        day: ["日", "月", "火", "水", "木", "金", "土"]
      }

      _.initials = {
        animating: false,
      }

      $.extend(_, _.initials);

      _.init();

    };

    return _Calselector;
  })();

  Calselector.prototype.init = function() {
    var _ = this;
  };

  Calselector.prototype.bindEvents = function () {
    this.on('click', function() {
      $(this)
    });
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  Calselector.prototype.bindEvents = function () {
  }

  $.fn.slick = function() {
    var _ = this,
      opt = arguments[0],
      args = Array.prototype.slice.call(arguments, 1),
      l = _.length,
      i,
      ret;
    for (i = 0; i < l; i++) {
      if (typeof opt == 'object' || typeof opt == 'undefined')
        _[i].calselector = new Calselector(_[i], opt);
      else
        ret = _[i].calselector[opt].apply(_[i].calselector, args);
      if (typeof ret != 'undefined') return ret;
    }
    return _;
  };
  
})(jQuery);