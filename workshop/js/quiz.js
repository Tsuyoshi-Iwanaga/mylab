'use strict';
;(function($, undefined){
  var Ctrl = (function () {

    var _func = {},

    _init = function () {
      _addjQuery();
    },

    //Add plugin to jQuery
    _addjQuery = function() {
      $.fn.quiz = function(){
        var _ = this,
          opt = arguments[0],
          l = _.length,
          i;

        for (i=0; i<l; i++) {
          if(typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].quiz = new _Quiz(_[i], opt);
          }
        }
        return _;
      };
    },

    //Constructer
    _Quiz = function(element, options) {
      var _ = this;

      _.$el = $(element);

      _.initials = {
        wrap : _.$el,
        data : {},
        items: _.$el.find('.js-quizItem'),
        btn: _.$el.find('.js-exec'),
        input: _.$el.find('.js-input'),
        result: _.$el.find('.js-output'),
        index: 1
      }
      _.settings = $.extend({}, _.initials, options);

     _.fire();
    },

    // public
    _func = {
      init: _init
    };

    _Quiz.prototype.fire = function () {
      var _ = this;


      _.settings.items.hide();
      _.settings.items.eq(0).show();

      _.bindEvents();
      _.getData();
    },

    _Quiz.prototype.getData = function () {
      var _ = this;

      //jQuery
      // $.ajax({
      //   url: "./json/quiz.json",
      //   method: "GET",
      // }).done(function(data){
      //   _.settings.data = data[0];
      // }).fail(function(){
      //   throw new Error("データ読み込みができませんでした");
      // });

      //fetchAPI
      //https://developer.mozilla.org/ja/docs/Web/API/Fetch_API/Using_Fetch
      fetch('./json/quiz.json', {method: 'GET'})
      .then(function(response){
        return response.json();
      })
      .then(function(json){
        _.settings.data = json[0];
      })
      .catch(() => {
        throw new Error("データ読み込みができませんでした");
      });
    },

    _Quiz.prototype.renderQuiz = function (index) {
      var _ = this;
      var input = _.settings.input.val();
      var exec = _.settings.data[index]["template"].replace('${input}', input);
      var answer = _.settings.data[index]["answer"];
      var output;

      try {
        output = Function(exec)();
      } catch {
        output = '実行時エラー';
      }

      if(String(output) === answer) {
        _.settings.result.html(`<span style="color: green;">正解です  あなたの回答:${output}<span>`);
      } else {
        _.settings.result.html(`<span style="color: red;">間違いです あなたの回答:${output}<span>`);
      }
    }

    _Quiz.prototype.bindEvents = function() {
      var _ = this;

      _.settings.btn.on('click', function(){
        _.renderQuiz(_.settings.index);
      });
    };

    return _func;

  }());

  $(function () {
    Ctrl.init();
  });

})(jQuery);
