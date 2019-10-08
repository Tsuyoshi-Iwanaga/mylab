<template lang="pug">
  .inputArea
    h3.reviewTitle ●保険プランの追加
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
      SimulatorA(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)")
      SimulatorB(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)")
      SimulatorC(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)")
      SimulatorD(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)")
      SimulatorE(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)")
      SimulatorF(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)")
      SimulatorG(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)")
      SimulatorH(:simulator="simulator" :priceTable="priceTable" @updatePlan="updatePlan($event)")
    p ※ホールインワン保険は単体でのご加入ができません。ご加入の場合は、医療保険、がん保険、就業不能保険、個人賠償責任保険、傷害保険、介護保険のいずれかにもご加入いただく必要があります。
    p
      button(@click="addReviewItem") この内容で検討中の保険プランに追加
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

  @Watch("priceTable")
  getPriceTable() {}

  @Emit("addReviewItem")
  addReviewItem() {
    let emitSimulator = Object.assign({}, this.simulator, {
      id: Number(`${new Date().getTime()}${Math.floor(Math.random() * 10)}`)
    });
    return emitSimulator;
  }
}
</script>

<style lang="scss" scoped>
.inputArea {
  margin: 2rem;
  padding: 2rem;
  border: 2px dotted #0f1269;
}
.reviewTitle {
  margin-bottom: 2rem;
}
.inputBasic {
  margin-bottom: 2rem;
}
.simulators_list {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
</style>
