<template lang="pug">
  .sim-area
    h3 医療保険(B)
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
  PlanB
} from "../../../type/simulator";

@Component
export default class SimulatorB extends Vue {
  //data
  price: number = 0;
  plan: string = "01";
  options: OptionItem[] = [
    { id: 1, name: "01", show: true },
    { id: 2, name: "02", show: true },
    { id: 3, name: "11", show: true },
    { id: 4, name: "12", show: true },
    { id: 5, name: "01W", show: true },
    { id: 6, name: "02W", show: true },
    { id: 7, name: "11W", show: true },
    { id: 8, name: "12W", show: true },
    { id: 9, name: "none", show: true }
  ];

  //Props
  @Prop({})
  simulator!: Simulator;
  @Prop({})
  priceTable!: priceTableJSON;

  updateGender(): void {
    if (this.simulator.gender === Gender.Male) {
      //女性のみパターンを選択時、男性に切り替える時はWを削除したプランとする
      if (this.plan.indexOf("W") > 0) {
        this.plan = this.plan.slice(0, -1);
      }
      this.options.forEach(v => {
        if (v.name.indexOf("W") > 0) {
          v.show = false;
        }
      });
    } else {
      this.options.forEach(v => {
        v.show = true;
      });
    }
  }

  @Watch("priceTable")
  getPriceTable() {
    this.getPrice();
  }

  @Watch("simulator", { deep: true })
  getSimulator() {
    this.updateGender();
    this.getPrice();
  }

  @Emit("updatePlan")
  updatePlan() {
    return {
      id: 1,
      plan: this.plan,
      price: this.price
    };
  }

  get planName(): string {
    if (this.plan == "none") {
      return "-";
    } else {
      return "B" + this.plan;
    }
  }

  getPrice(): void {
    if (this.priceTable["B"]) {
      this.price = this.priceTable["B"][this.plan][this.simulator.gender][
        this.simulator.age
      ];
    }
  }

  created() {
    this.plan = this.simulator.planList[1];
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
