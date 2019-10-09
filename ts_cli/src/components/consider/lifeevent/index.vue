<template lang="pug">
.top
  Header
  p ライフイベント
  p
    a(href="/") トップ
  p
    a(href="/consider/simulation/") 全商品シミュレータへ
  .personSec
    h2 本人
    p 年齢：35-39
    p 性別：男性
    p 金額：5440
    p プラン：["01","01","01","01","01","01","01","01"]
  .personSec
    h2 配偶者
    p 年齢：30-34
    p 性別：女性
    p 金額：4680
    p プラン：["01","01","01","01","01","01","01","01"]
  .personSec
    h2 こども
    p 年齢：10-14
    p 性別：男性
    p 金額：2570
    p プラン：["01","01","01","01","01","01","01","01"]
  button(@click="judgeOverRide" style="margin-bottom: 20px;margin-left: 20px;") データ更新
  Footer
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import localStorageIO from "../../../functions/localStorageIO";
import Header from "../../common/header.vue";
import Footer from "../../common/footer.vue";
import {
  Gender,
  Age,
  priceTableJSON,
  Simulator
} from "../../../type/simulator";

@Component({
  components: {
    Header,
    Footer
  }
})
export default class LifeEvent extends Vue {
  dataUpdate() {
    localStorageIO.updateLocalStorage("simulator", [
      {
        id: 1,
        price: 0,
        gender: "male",
        age: "35-39",
        planList: ["01", "01", "01", "01", "01", "01", "01", "01"]
      },
      {
        id: 2,
        price: 0,
        gender: "female",
        age: "30-34",
        planList: ["01", "01", "01", "01", "01", "01", "01", "01"]
      },
      {
        id: 3,
        price: 0,
        gender: "male",
        age: "10-14",
        planList: ["01", "01", "01", "01", "01", "01", "01", "01"]
      }
    ]);
    window.confirm("プランを上書きました");
  }

  judgeOverRide() {
    if (!localStorageIO.getLocalStorage("simulator")) {
      this.dataUpdate();
      return;
    }
    if (window.confirm("全商品シミュレータのプランを上書きます。")) {
      this.dataUpdate();
    }
  }
}
</script>

<style lang="scss" scoped>
.personSec {
  background: #666;
  margin: 2rem;
  width: 100%;
  max-width: 30rem;
  padding: 2rem;
  color: #fff;
}
</style>
