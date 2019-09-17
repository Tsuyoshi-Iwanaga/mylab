import Vue, { VNode } from 'vue';
import SimulatorContainer from './components/simulatorContainer.vue';

new Vue({
  el: '#app',
  render: (h): VNode => h(SimulatorContainer),
});