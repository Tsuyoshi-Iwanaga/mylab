import Vue from "vue";
import "../../assets/common/scss/global.scss";
import Cancer from "../../components/product/product_cancer.vue";

Vue.config.productionTip = false;

new Vue({
  render: h => h(Cancer)
}).$mount("#container");
