import Vue from "vue";
import "../../assets/common/scss/global.scss";
import SimulatorContainer from "../../components/simulators/simulatorContainer.vue";

Vue.config.productionTip = false;

new Vue({
  render: h => h(SimulatorContainer)
}).$mount("#app");
