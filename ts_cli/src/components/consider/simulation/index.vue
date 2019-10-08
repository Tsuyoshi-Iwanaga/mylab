<template lang="pug">
.top
  Header
  h2 商品から選ぶ
    br
    | 保険料シミュレーター
  p 必要な保険、必要な補償を組み合わせて、
    br
    | 家族の保険プランをご案内します。
    SimulatorReview(:simulators="simulators" @removePlan="removePlan($event)")
    SimulatorInput(@addReviewItem="addReviewItem($event)")
  Footer
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Header from "../../common/header.vue";
import Footer from "../../common/footer.vue";
import localStorageIO from "../../../functions/localStorageIO";
import fetchData from "../../../functions/fetch";
import SimulatorInput from "./simulatorInput.vue";
import SimulatorReview from "./simulatorReview.vue";
import {
  Gender,
  Age,
  Simulator,
  priceTableJSON
} from "../../../type/simulator";

@Component({
  components: {
    Header,
    Footer,
    SimulatorReview,
    SimulatorInput
  }
})
export default class Index extends Vue {
  reviewAreaShow: boolean = true;
  simulators: Simulator[] = [];
  priceTable: priceTableJSON = {};

  //検討中プラン削除
  removePlan($event: number) {
    this.simulators.forEach((v: Simulator, i: number, arr: Simulator[]) => {
      if (v.id === $event) {
        arr.splice(i, 1);
      }
    });
  }

  //
  addReviewItem($event: Simulator) {
    this.simulators.push($event);
  }

  updated() {
    localStorageIO.updateLocalStorage("simulator", this.simulators);
  }

  created() {
    //料金テーブルデータ取得
    fetchData("../../json/priceTable.json")
      .then(response => {
        this.priceTable = response.data as priceTableJSON;
      })
      .catch(error => {
        throw new Error(error);
      });

    //Storageデータ読み込み
    if (localStorageIO.getLocalStorage("simulator")) {
      this.simulators = localStorageIO.getLocalStorage(
        "simulator"
      ) as Simulator[];
    }

    //検討中エリア表示制御
    if (this.simulators.length === 0) {
      this.reviewAreaShow = false;
    }
  }
}
</script>

<style lang="scss" scoped></style>
