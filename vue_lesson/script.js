;(function(){



Vue.component('my-hoge', {
  el: '#app',
  template: ``,
  data: function() {
    return {
      message: 'Vue.js'
    }
  }
});

let vm = new Vue({
  el: '#app',
  template: `<my-hoge></my-hoge>`
});

})();