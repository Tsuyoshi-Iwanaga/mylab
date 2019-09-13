import Vue, { VNode } from 'vue';
import SimulatorWrap from './components/simulatorWrap.vue';

new Vue({
  el: '#app',
  render: (h): VNode => h(SimulatorWrap),
});