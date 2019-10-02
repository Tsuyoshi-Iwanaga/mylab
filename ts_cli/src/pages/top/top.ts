import Vue from "vue";
import "../../assets/common/scss/global.scss";
import Top from "../../components/top/top.vue";

Vue.config.productionTip = false;

new Vue({
  render: h => h(Top)
}).$mount("#app");
