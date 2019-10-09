<template lang="pug">
.review
  .reviewTitle {{simulator.type}}の保険プラン
  p 年齢: {{simulator.age}}歳
  p 性別: {{genderValue}}
  p 月払保険料: {{sumPrice}}円
  .reviewItem
    .reviewBox.simA
      p.boxTitle 医療保険
      p 保証タイプ:{{planAType}}
    .reviewBox.simB
      p.boxTitle がん保険
      p 保証タイプ:{{planBType}}
    .reviewBox.simC
      p.boxTitle 就業不能保険
      p 保証タイプ:{{planCType}}
    .reviewBox.simD
      p.boxTitle 個人賠償責任保険
      p 保証タイプ:{{planDType}}
    .reviewBox.simE
      p.boxTitle 損害保険
      p 保証タイプ:{{planEType}}
    .reviewBox.simF
      p.boxTitle 介護保険
      p 保証タイプ:{{planFType}}
    .reviewBox.simG
      p.boxTitle 携行品損害保険
      p 保証タイプ:{{planGType}}
    .reviewBox.simH
      p.boxTitle ホールインワン保険
      p 保証タイプ:{{planHType}}
  p(style="margin-bottom:10px")
    button(@click="rewritePlan") 保証内容を編集する
  p
    button(@click="removePlan") このプランを削除する
</template>

<script lang="ts">
import { Component, Vue, Prop, Emit } from "vue-property-decorator";
import { Gender, Age, Simulator } from "../../../type/simulator";

@Component({
  components: {}
})
export default class SimulatorContainer extends Vue {
  applyUrl: string = "#";

  //Props
  @Prop({})
  simulator!: Simulator;

  @Emit("removePlan")
  removePlan() {
    return this.simulator.id;
  }

  get sumPrice() {
    return this.simulator.priceList.reduce((a, b) => {
      return a + b;
    });
  }

  get genderValue() {
    if (this.simulator.gender === "male") return "男性";
    if (this.simulator.gender === "female") return "女性";
    return false;
  }

  get planAType() {
    return this.simulator.planList[0] === "none"
      ? "-"
      : "A" + this.simulator.planList[0];
  }
  get planBType() {
    return this.simulator.planList[1] === "none"
      ? "-"
      : "B" + this.simulator.planList[1];
  }
  get planCType() {
    return this.simulator.planList[2] === "none"
      ? "-"
      : "C" + this.simulator.planList[2];
  }
  get planDType() {
    return this.simulator.planList[3] === "none"
      ? "-"
      : "D" + this.simulator.planList[3];
  }
  get planEType() {
    return this.simulator.planList[4] === "none"
      ? "-"
      : "E" + this.simulator.planList[4];
  }
  get planFType() {
    return this.simulator.planList[5] === "none"
      ? "-"
      : "F" + this.simulator.planList[5];
  }
  get planGType() {
    return this.simulator.planList[6] === "none"
      ? "-"
      : "G" + this.simulator.planList[6];
  }
  get planHType() {
    return this.simulator.planList[7] === "none"
      ? "-"
      : "H" + this.simulator.planList[7];
  }

  rewritePlan() {
    console.log("modalOpen?");
  }
}
</script>

<style lang="scss" scoped>
.review {
  padding: 2rem;
  background: #d3def1;
  margin: 2rem 0 2rem;
}
.reviewItem {
  margin-top: 2rem;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
.reviewBox {
  background: #eee;
  padding: 1rem;
  margin-bottom: 2rem;
  width: 20%;
}
.boxTitle {
  font-weight: bold;
}
</style>
