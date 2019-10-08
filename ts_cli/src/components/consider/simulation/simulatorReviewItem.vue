<template lang="pug">
.review
  .reviewTitle あなたの保険プラン
  p 年齢: {{simulator.age}}
  p 性別: {{simulator.gender}}
  p 月払保険料: {{simulator.price}}
  .reviewItem
    .reviewBox.simA
      p.boxTitle 医療保険
      p 保証タイプ:{{simulator.planList[0]}}
    .reviewBox.simB
      p.boxTitle がん保険
      p 保証タイプ:{{simulator.planList[1]}}
    .reviewBox.simC
      p.boxTitle 就業不能保険
      p 保証タイプ:{{simulator.planList[2]}}
    .reviewBox.simD
      p.boxTitle 個人賠償責任保険
      p 保証タイプ:{{simulator.planList[3]}}
    .reviewBox.simE
      p.boxTitle 損害保険
      p 保証タイプ:{{simulator.planList[4]}}
    .reviewBox.simF
      p.boxTitle 介護保険
      p 保証タイプ:{{simulator.planList[5]}}
    .reviewBox.simG
      p.boxTitle 携行品損害保険
      p 保証タイプ:{{simulator.planList[6]}}
    .reviewBox.simH
      p.boxTitle ホールインワン保険
      p 保証タイプ:{{simulator.planList[7]}}
  p(style="margin-bottom:10px")
    button 保証内容を編集する
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
