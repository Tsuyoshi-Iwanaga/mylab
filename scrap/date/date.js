;(function($){
  'use strict';

  var CalTimePicker = window.CalTimePicker || {};

  //コンストラクタ
  CalTimePicker = function(element, options){
    var _ = this;

    _.initials = {
      dateHead: ['月','火','水','木','金','土','日'],
      disabledDates: ['2019/03/21', '2019/03/21', '2019/03/21'],
      minDate: '1970/01/01',
      maxDate: '1970/01/01',
      disabledWeekDays: [0,4,5,6],
      startDate: new Date('1970-01-06').getTime(),
      endDate: new Date('1970-03-01').getTime(),
      activeClassName: 'is-active',
      disabledClassName: 'is-disabled',
      excludedClassName: 'is-excluded',
    };

    _.state = {
      selectedDate: null,
      selectedTime: null,
    }

    _.settings = $.extend({}, _.initials, options);

    _.init(element);
  };

  //初回実行
  CalTimePicker.prototype.init = function(element){
    var _ = this;
    _.renderCal();
  };

  //カレンダー描画
  CalTimePicker.prototype.renderCal = function(element){
    var _ = this;
  };

  //メソッド例
  CalTimePicker.prototype.xxx = function(element) {
    var _ = this;
  };

  //メソッド例
  CalTimePicker.prototype.xxx = function(element) {
    var _ = this;
  };

  //メソッド例
  CalTimePicker.prototype.xxx = function(element) {
    var _ = this;
  };

  //メソッド例
  CalTimePicker.prototype.xxx = function(element) {
    var _ = this;
  };

  //メソッド例
  CalTimePicker.prototype.xxx = function(element) {
    var _ = this;
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
