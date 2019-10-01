import Vue from "vue";
import SimulatorContainer from "../../components/simulators/simulatorContainer.vue";

Vue.config.productionTip = false;

new Vue({
  render: h => h(SimulatorContainer)
}).$mount("#app");
