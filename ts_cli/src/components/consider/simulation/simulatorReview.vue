<template lang="pug">
.reviewArea(v-show="areaShow")
  h3.reviewTitle ●検討中の保険プラン
  p(style="margin-bottom: 10px") 選択済みの保険プランの合計保険料 {{sumAllPrice}}円
  p
    a(:href="applyUrl") この保険の検討を進める
  SimulatorReviewItem(v-for="simulator in simulators" :key="simulator.id" :simulator="simulator" @removePlan="removePlan($event)")
  p
    a(:href="applyUrl") この保険の検討を進める
</template>

<script lang="ts">
import { Component, Vue, Prop, Emit, Watch } from "vue-property-decorator";
import SimulatorReviewItem from "./simulatorReviewItem.vue";
import { Gender, Age, Simulator } from "../../../type/simulator";

@Component({
  components: {
    SimulatorReviewItem
  }
})
export default class SimulatorReview extends Vue {
  areaShow: boolean = true;
  applyUrl: string = "#";

  //Props
  @Prop({})
  simulators!: Simulator[];

  //全体の合計金額
  get sumAllPrice(): number {
    let priceSum = 0;
    this.simulators.forEach((v: Simulator) => {
      let sum = v.priceList.reduce((a, b) => {
        return a + b;
      });
      priceSum += sum;
    });
    return priceSum;
  }

  @Emit("removePlan")
  removePlan($event: number) {
    return $event;
  }

  @Watch("simulators", { deep: true })
  checkSimulator() {
    this.switchAreaShow();
  }

  //エリア全体の表示切り替え
  switchAreaShow() {
    this.areaShow = this.simulators.length === 0 ? false : true;
  }

  created() {
    this.switchAreaShow();
  }
}
</script>

<style lang="scss" scoped>
.reviewArea {
  margin: 2rem;
  padding: 2rem;
  border: 2px dotted #0f1269;
}
</style>
