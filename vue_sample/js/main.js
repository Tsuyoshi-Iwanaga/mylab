;(function(){
  'use strict';

  const vm = new Vue({
    //Target
    el: '#app',

    //Models
    data: {
      todos: [],
      newItem: ''
    },

    //監視
    watch: {
      todos: {
        handler: function() {
          localStorage.setItem('todos', JSON.stringify(this.todos));
        },
        deep: true
      }
    },

    //ライフサイクル
    mounted: function() {
      this.todos = JSON.parse(localStorage.getItem('todos')) || [];
    },

    //Methods
    methods: {
      addItem: function() {
        this.todos.push({
          title: this.newItem,
          isDone: false
        });
        this.newItem = '';
      },
      deleteItem: function(index) {
        if(confirm('are you sure?')) {
          this.todos.splice(index, 1);
        }
      },
      purge: function() {
        if(!confirm('delete finished?')) {
          return;
        }
        this.todos = this.remaining;
      }
    },

    //算出プロパティ
    computed: {
      remaining: function() {
        var items = this.todos.filter(todo => {
          return !todo.isDone;
        });
        return items;
      }
    },
  });

  //==== Component ====
  const likeComponent = Vue.extend({
    template: '<button @click="countUp">{{message}} {{count}}</button>',

    props: {
      message: {
        type: String,
        default: 'Like'
      }
    },

    //コンポーネントのdataは必ず関数で値を返す必要がある
    data: function() {
      return {
        count: 0
      }
    },

    methods: {
      countUp: function() {
        this.count++;
        this.$emit('increment');
      }
    }
  });

  const btnArea = new Vue({
    el: '#wrap01',

    components: {
      'like-component': likeComponent
    },

    data: {
      total: 0
    },

    methods: {
      incrementTotal: function() {
        this.total++;
      }
    }
  });

})();
