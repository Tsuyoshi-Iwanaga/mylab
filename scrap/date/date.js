;(function($){
  'use strict';

  var CalTimePicker = window.CalTimePicker || {};

  //コンストラクタ
  CalTimePicker = function(element, options){
    var _ = this;

    _.initials = {
      initial_font: 12,
      max_font: 24,
      enlarge_ratio: 1.2
    };

    _.settings = $.extend({}, _.initials, options);

    _.init(element);
  };

  //初回実行
  CalTimePicker.prototype.init = function(element){
    var _ = this;
    console.log(_);
  };

  //メソッド例
  CalTimePicker.prototype.xxx = function(element) {
    var _ = this;
  };

  //jQueryへ追加
  $.fn.calTimePicker = function(){
    var _ = this,
        opt = arguments[0],
        l = _.length,
        i;

    for(i=0; i<l; i++){
      if(typeof opt == 'object' || typeof opt == 'undefined'){
        _[i].CalTimePicker = new CalTimePicker(_[i], opt);
      }
    }
    return _;
  };

})(jQuery);
