<template lang="pug">
  .inputArea
    p 保険をご検討の方
      select(v-model="simulator.type")
        option(value="you") あなた
        option(value="spouse") 配偶者
        option(value="child") 子ども
        option(value="father") 父親
        option(value="mother") 母親
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
    //- SimulatorA(:simulator="simulator")
    //- SimulatorB(:simulator="simulator")
    //- SimulatorC(:simulator="simulator")
    //- SimulatorD(:simulator="simulator")
    //- SimulatorE(:simulator="simulator")
    //- SimulatorF(:simulator="simulator")
    //- SimulatorG(:simulator="simulator")
    //- SimulatorH(:simulator="simulator")
    p
      button(@click="addReviewItem") プランを追加する
</template>

<script lang="ts">
import { Component, Vue, Prop, Emit } from "vue-property-decorator";
import localStorageIO from "../../../functions/localStorageIO";
import SimulatorA from "./simulatorA.vue";
import SimulatorB from "./simulatorB.vue";
import SimulatorC from "./simulatorC.vue";
import SimulatorD from "./simulatorD.vue";
import SimulatorE from "./simulatorE.vue";
import SimulatorF from "./simulatorF.vue";
import SimulatorG from "./simulatorG.vue";
import SimulatorH from "./simulatorH.vue";
import { Gender, Age, Simulator, Type } from "../../../type/simulator";

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
    price: 0,
    age: Age.T7,
    gender: Gender.Male,
    planList: ["01", "01", "01", "01", "01", "01", "01", "01"],
    type: Type.You
  };

  @Emit("addReviewItem")
  addReviewItem() {
    this.simulator = Object.assign({}, this.simulator, {
      id: Number(`${new Date().getTime()}${Math.floor(Math.random() * 10)}`)
    });
    return this.simulator;
  }
}
</script>

<style lang="scss" scoped>
.inputArea {
  margin: 2rem;
  padding: 2rem;
  border: 2px dotted #0f1269;
}
</style>
