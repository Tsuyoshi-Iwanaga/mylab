;(function($){
  'use strict';

  var CalTimePicker = window.CalTimePicker || {};

  //コンストラクタ
  CalTimePicker = function(element, options){
    var _ = this;

    _.initials = {
      dateHead: ['日','月','火','水','木','金','土'],
      timeItems: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'],
      disabledDates: [],
      disabledWeekDays: [],
      irregularDates: [],
      startDate: null,
      endDate: null,
      activeClassName: 'is-active',
      disabledClassName: 'is-disabled',
      excludedClassName: 'is-excluded',
    };

    _.$el = $(element);

    _.state = {
      nowYear: null,
      nowMonth: null,
      selectedYear: null,
      selectedMonth: null,
      selectedDate: null,
      selectedTime: null,
    }

    _.settings = $.extend({}, _.initials, options);

    _.init();
  };

  //初回実行
  CalTimePicker.prototype.init = function(){
    var _ = this;
    _.setYMDState();
    _.generate();
    _.renderCal(0);
    _.bindEvents();
    _.$el.parent().find('.js-timeItem').eq(0).trigger('click');
    _.$el.parent().find('.calWrap').hide();
  };

  //初期描画
  CalTimePicker.prototype.generate = function(){
    var _ = this,
        $wrapper = $('<div></div>'),
        $contents = $('<div class="calWrap"></div>'),
        $calWrap = $('<div class="calMont_wrap"></div>'),
        $timeWrap = $('<div class="calTime"></div>'),
        $timeRow = $('<div class="calTime_row"></div>'),

        $swicher = $('<div class="calMonth_switch"><p class="calMonth_switcher -back js-calMonthBack">←</p><p class="calMonth_title"><span class="js-yearItem"></span>年&nbsp;<span class="js-monthItem"></span>月</p><p class="calMonth_switcher -foward js-calMonthFoward">→</p></div>'),
        $monthCol = $('<div class="calMonth_cal"></div>'),
        $timeCol = $('<div class="calTime"></div>'),
        $timeWrap = $('<div class="calTime_wrap"></div>');

    //カレンダー部
    for(var i = 0; i < 7; i++) {
      var $calRow = $('<div class="calMonth_row"></div>');
      if(i === 0) {
        _.settings.dateHead.forEach(function(v) {
          $calRow.append($('<p class="calMonth_date -label">' + v + '</p>'))
        });
      } else {
        _.settings.dateHead.forEach(function() {
          $calRow.append($('<p class="calMonth_date -select js-dateItem"></p>'))
        });
      }
      $monthCol.append($calRow);
    }

    //時間セレクト部
    _.settings.timeItems.forEach(function(v) {
      $timeRow.append($('<p class="calTime_time js-timeItem">' + v + '</p>'));
    });
    $timeWrap.append($timeRow);
    $timeCol.append($timeWrap);

    //ラッパー
    $wrapper.css({position: 'relative', display: 'inline-block', height: _.$el.outerHeight(), lineHeight: '1.0', fontSize: '0', verticalAlign: 'top'});
    $contents.css({position: 'absolute', top: _.$el.outerHeight() + 8, left: '0', width: '31.0rem', zIndex: '100'});

    //組み立て、レンダリング
    $calWrap.append($swicher, $monthCol);
    $timeCol.append($timeWrap);
    $contents.append($calWrap, $timeCol);
    $wrapper.append($contents);
    _.$el.before($wrapper);
  };

  //初期日時設定
  CalTimePicker.prototype.setYMDState = function() {
    var _ = this,
        now = new Date();

    _.state.nowYear = now.getFullYear();
    _.state.nowMonth = now.getMonth() + 1;
    _.state.selectedDate = now.getDate();

  };

  //カレンダー描画
  CalTimePicker.prototype.renderCal = function(num){
    var _ = this,
        day = new Date(_.state.nowYear + '/' + (_.state.nowMonth) + '/' + _.state.selectedDate),
        monthProceed = num || 0,
        items = _.$el.parent().find('.js-dateItem'),
        lastLowFlag = false;

    day.setMonth(day.getMonth() + monthProceed);

    _.state.nowMonth = day.getMonth() + 1;
    _.state.nowYear = day.getFullYear();

    _.$el.parent().find('.js-dateItem').removeClass(_.settings.disabledClassName);
    _.$el.parent().find('.js-dateItem').removeClass(_.settings.excludedClassName);
    _.$el.parent().find('.js-dateItem').removeClass(_.settings.activeClassName);
    _.$el.parent().find('.js-yearItem').text(_.state.nowYear);
    _.$el.parent().find('.js-monthItem').text(_.state.nowMonth);

    day.setDate(1);
    day.setDate(day.getDate() - (day.getDay()));

    for(var i=0; i < 42; i++) {
      items.eq(i).text(day.getDate());

      //すでに選択した日がある場合
      if(day.getFullYear() === _.state.selectedYear && day.getMonth()+1 === _.state.selectedMonth && day.getDate() === _.state.selectedDate) {
        _.$el.parent().find('.js-dateItem').eq(i).addClass(_.settings.activeClassName);
      }

      //対象でない月は無効化
      if(day.getMonth() + 1 !== Number(_.state.nowMonth)) {
        _.$el.parent().find('.js-dateItem').eq(i).addClass(_.settings.excludedClassName);
      }

      //対象でない曜日は無効化
      if(_.settings.disabledWeekDays.indexOf(day.getDay()) >= 0) {
        _.$el.parent().find('.js-dateItem').eq(i).addClass(_.settings.disabledClassName);
      }

      //対象でない日は無効化
      if(_.settings.disabledDates.indexOf(day.getFullYear() + '/' + (day.getMonth() + 1) + '/' + day.getDate()) >= 0) {
        _.$el.parent().find('.js-dateItem').eq(i).addClass(_.settings.disabledClassName);
      }

      //対象の開始期間以前は無効化
      if(_.settings.startDate) {
        if(new Date().getTime() + _.settings.startDate > day.getTime()) {
          _.$el.parent().find('.js-dateItem').eq(i).addClass(_.settings.disabledClassName);
        }
      }

      //対象の終了期間以前は無効化
      if(_.settings.endDate) {
        if(new Date().getTime() + _.settings.endDate < day.getTime()) {
          _.$el.parent().find('.js-dateItem').eq(i).addClass(_.settings.disabledClassName);
        }
      }

      //本来選択無効となる日のイレギュラー対応
      if(_.settings.irregularDates.indexOf(day.getFullYear() + '/' + (day.getMonth() + 1) + '/' + day.getDate()) >= 0) {
        _.$el.parent().find('.js-dateItem').eq(i).removeClass(_.settings.disabledClassName);
      }

      day.setDate(day.getDate() + 1);
    }

    //最終行が必要ない場合は削除
    _.$el.parent().find('.calMonth_row').last().children('.js-dateItem').each(function(){
      if(!$(this).hasClass(_.settings.excludedClassName)){
        lastLowFlag = true;
      }
    });
    if(lastLowFlag) {
      _.$el.parent().find('.calMonth_row').last().show();
    } else {
      _.$el.parent().find('.calMonth_row').last().hide();
    }
  };

  //イベント登録
  CalTimePicker.prototype.bindEvents = function() {
    var _ = this;

    _.$el.parent().find('.js-calMonthBack').on('click', function() {
      _.renderCal(-1);
    });

    _.$el.parent().find('.js-calMonthFoward').on('click', function() {
      _.renderCal(1);
    });

    _.$el.parent().find('.js-dateItem').on('click', function(){
      if($(this).hasClass(_.settings.disabledClassName) || $(this).hasClass(_.settings.excludedClassName)) { return; }
      _.state.selectedDate = null;
      _.$el.parent().find('.js-dateItem').removeClass(_.settings.activeClassName);
      $(this).addClass(_.settings.activeClassName);
      _.state.selectedYear = Number(_.$el.parent().find('.js-yearItem').text());
      _.state.selectedMonth = Number(_.$el.parent().find('.js-monthItem').text());
      _.state.selectedDate = Number($(this).text());
      if(_.judgeSelectComplete()) {
        _.inputDateTime();
      }
    });

    _.$el.parent().find('.js-timeItem').on('click', function(){
      _.state.selectedTime = null;
      _.$el.parent().find('.js-timeItem').removeClass(_.settings.activeClassName);
      $(this).addClass(_.settings.activeClassName);
      _.state.selectedTime = $(this).text();
      if(_.judgeSelectComplete()) {
        _.inputDateTime();
      }
    });

    _.$el.on('click focus', function(){
      $('.calWrap').hide();
      $(this).attr('disabled', 'true');
      _.$el.parent().find('.calWrap').show();
    });

    _.$el.parent().find('.calWrap').on('click', function(){
      return false;
    });

    $(document).on('click focus', function(ev) {
      if(ev.target === _.$el[0]) { return }
      _.$el.attr('disabled', false);
      _.$el.parent().find('.calWrap').hide();
    });
  };

  //日にちと時間が選択されているかの判定
  CalTimePicker.prototype.judgeSelectComplete = function() {
    var _ = this;

    if(_.state.selectedYear && _.state.selectedMonth && _.state.selectedDate && _.state.selectedTime) {
      return true;
    } else {
      return false;
    }

  };

  //フォームへ出力
  CalTimePicker.prototype.inputDateTime = function() {
    var _ = this;
    _.$el.val(_.state.selectedYear + '/' + _.state.selectedMonth + '/' + _.state.selectedDate + ' ' + _.state.selectedTime);
    _.$el.attr('disabled', false);
    _.$el.trigger('change');
    _.$el.parent().find('.calWrap').hide();
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
