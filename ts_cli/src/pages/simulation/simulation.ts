import Vue from "vue";
import "../../assets/common/scss/global.scss";
import Index from "../../components/simulators/index.vue";

Vue.config.productionTip = false;

new Vue({
  render: h => h(Index)
}).$mount("#container");
