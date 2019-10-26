import Vue, { VNode } from 'vue';
import XXX from './components/XXX.vue';

new Vue({
  el: '#app',
  render: (h): VNode => h(XXX),
});