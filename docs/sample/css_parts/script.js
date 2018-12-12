;(function($){
  $(function(){
    var accWrap = $('.js-accodion'),
        accTitle = accWrap.find('dt'),
        activeClass = 'is-active';

    accTitle.on('click', function(){
      if($(this).parent().hasClass(activeClass)) {
        $(this).parent().removeClass(activeClass)
      } else {
        $(this).parent().addClass(activeClass)
      }
    });
  });
})(jQuery);
