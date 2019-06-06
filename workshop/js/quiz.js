'use strict';
;(function($, undefined){
  //input
  $('.js-exec').on('click', function(){
    var input = $('.js-input').val();
    var exec = `
    var a = 1;
    ${input}
    return a + b;
    `;
    var answer = 3;
    var output;

    try {
      output = Function(exec)();
    } catch {
      output = '実行時エラー';
    }

    if(output === answer) {
      $('.js-output').html(`<span style="color: green;">正解です  あなたの回答:${output}<span>`);
    } else {
      $('.js-output').html(`<span style="color: red;">間違いです あなたの回答:${output}<span>`);
    }
  });
})(jQuery);
