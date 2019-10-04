import Vue from "vue";
import "../../assets/common/scss/global.scss";
import Medical from "../../components/product/product_medical.vue";

Vue.config.productionTip = false;

new Vue({
  render: h => h(Medical)
}).$mount("#container");
