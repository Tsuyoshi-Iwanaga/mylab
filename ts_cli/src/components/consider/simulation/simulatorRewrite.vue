<template lang="pug">
  .inputArea
    h3.reviewTitle ●保険プランの修正
    h4 保険プランの条件選択
    .inputBasic
      p 保険をご検討の方
        select(v-model="simulator.type")
          option(value="あなた") あなた
          option(value="配偶者") 配偶者
          option(value="子ども") 子ども
          option(value="父親") 父親
          option(value="母親") 母親
      p 年齢
        select(v-model="simulator.age")
          option(value="0-4") 0-4歳
          option(value="5-9") 5-9歳
          option(value="10-14") 10-14歳
          option(value="15-19") 15-19歳
          option(value="20-24") 20-24歳
          option(value="25-29") 25-29歳
          option(value="30-34") 30-34歳
          option(value="35-39") 35-39歳
          option(value="40-44") 40-44歳
          option(value="45-49") 45-49歳
          option(value="50-54") 50-54歳
          option(value="55-59") 55-59歳
          option(value="60-64") 60-64歳
          option(value="65-69") 65-69歳
          option(value="70-74") 70-74歳
          option(value="75-79") 75-79歳
          option(value="80-84") 80-84歳
          option(value="85-89") 85-89歳
      p 性別
        select(v-model="simulator.gender")
          option(value="male") 男性
          option(value="female") 女性
    h4 保険商品の選択
    .simulators_list
      SimulatorA(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)" class="-rewrite")
      SimulatorB(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)" class="-rewrite")
      SimulatorC(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)" class="-rewrite")
      SimulatorD(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)" class="-rewrite")
      SimulatorE(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)" class="-rewrite")
      SimulatorF(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)" class="-rewrite")
      SimulatorG(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)" class="-rewrite")
      SimulatorH(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)" class="-rewrite")
    p
      button(@click="rewriteItem") この内容でプランを修正
</template>

<script lang="ts">
import { Component, Vue, Prop, Emit, Watch } from "vue-property-decorator";
import localStorageIO from "../../../functions/localStorageIO";
import SimulatorA from "./simulatorA.vue";
import SimulatorB from "./simulatorB.vue";
import SimulatorC from "./simulatorC.vue";
import SimulatorD from "./simulatorD.vue";
import SimulatorE from "./simulatorE.vue";
import SimulatorF from "./simulatorF.vue";
import SimulatorG from "./simulatorG.vue";
import SimulatorH from "./simulatorH.vue";
import {
  Gender,
  Age,
  Simulator,
  Type,
  TypeInfo,
  priceTableJSON
} from "../../../type/simulator";

@Component({
  components: {
    SimulatorA,
    SimulatorB,
    SimulatorC,
    SimulatorD,
    SimulatorE,
    SimulatorF,
    SimulatorG,
    SimulatorH
  }
})
export default class simulatorInput extends Vue {
  simulator: Simulator = {
    id: 0,
    age: Age.T7,
    gender: Gender.Male,
    planList: ["01", "01", "01", "01", "01", "01", "01", "01"],
    priceList: [0, 0, 0, 0, 0, 0, 0, 0],
    type: Type.You
  };

  updatePlan($event: TypeInfo) {
    Vue.set(this.simulator.planList, $event.id, $event.plan);
    Vue.set(this.simulator.priceList, $event.id, $event.price);
  }

  @Prop()
  priceTable!: priceTableJSON;
  @Prop()
  propSimulator!: Simulator;

  @Watch("priceTable")
  getPriceTable() {}

  @Emit("rewriteItem")
  rewriteItem() {
    return this.simulator;
  }

  created() {
    //Propのディープコピーを生成して差し替え
    this.simulator = JSON.parse(JSON.stringify(this.propSimulator));
  }
}
</script>

<style lang="scss" scoped>
.reviewTitle {
  margin-bottom: 2rem;
}
.inputBasic {
  margin-bottom: 2rem;
}
.simulators_list {
  display: flex;
  flex-wrap: wrap;
}
</style>
