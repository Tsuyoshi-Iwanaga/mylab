<template lang="pug">
  .sim-area
    h3 就業不能保険(E)
    p プラン:{{ planName }}
    p 値段:{{ price }}円
    select(v-model="plan")
      option(v-show="option.show" v-for="option in options" :value="option.name" :key="option.id") {{ option.name }}
</template>

<script lang="ts">
import { Component, Prop, Emit, Watch, Vue } from "vue-property-decorator";
import {
  OptionItem,
  Simulator,
  Gender,
  priceTableJSON,
  PlanE
} from "../../../type/simulator";

@Component
export default class SimulatorE extends Vue {
  //data
  price: number = 0;
  plan: string = "01";
  options: OptionItem[] = [
    { id: 1, name: "01", show: true },
    { id: 2, name: "02", show: true },
    { id: 3, name: "11", show: true },
    { id: 4, name: "12", show: true },
    { id: 5, name: "none", show: true }
  ];

  //Props
  @Prop({})
  simulator!: Simulator;
  @Prop({})
  priceTable!: priceTableJSON;

  @Watch("priceTable")
  getPriceTable() {
    this.getPrice();
  }

  @Watch("simulator", { deep: true })
  getSimulator() {
    this.getPrice();
  }

  @Emit("updatePlan")
  updatePlan() {
    return {
      id: 4,
      plan: this.plan,
      price: this.price
    };
  }

  get planName(): string {
    if (this.plan == "none") {
      return "-";
    } else {
      return "E" + this.plan;
    }
  }

  getPrice(): void {
    if (this.priceTable["E"]) {
      this.price = this.priceTable["E"][this.plan][this.simulator.gender][
        this.simulator.age
      ];
    }
  }

  created() {
    this.plan = this.simulator.planList[4];
  }

  updated() {
    this.getPrice();
    this.updatePlan();
  }
}
</script>

<style lang="scss" scoped>
.sim-area {
  margin: 10px 0;
  width: 20%;
  background: #eee;
  padding: 20px;
}
.sim-area.-rewrite {
  width: 12rem;
  margin-right: 1rem;
}
</style>
