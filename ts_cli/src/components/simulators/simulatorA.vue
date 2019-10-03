<template>
  <div class="sim-area">
    <h3>傷害保険(A)</h3>
    <p>プラン:A{{ plan }}</p>
    <p>値段:{{ price }}</p>
    <select v-model="plan">
      <option v-for="option in options" :value="option.name" :key="option.id">{{
        option.name
      }}</option>
    </select>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Emit, Watch, Vue } from "vue-property-decorator";
import {
  Gender,
  Age,
  OptionItem,
  priceTableJSON,
  PlanA
} from "../../type/simulator";

@Component
export default class SimulatorA extends Vue {
  //data
  price: number = 0;
  plan: string = "01";
  options: OptionItem[] = [
    { id: 1, name: "01", show: true },
    { id: 2, name: "none", show: true }
  ];

  //Props
  @Prop({})
  gender!: Gender;
  @Prop({})
  age!: Age;
  @Prop({})
  propplan!: string;
  @Prop({})
  priceTable!: priceTableJSON;

  //Emit
  @Emit("getPlan")
  sendInfo() {
    return {
      id: 0,
      plan: this.plan,
      price: this.price
    };
  }

  //method
  getPrice(): void {
    if (this.priceTable["A"]) {
      this.price = this.priceTable["A"][this.plan][this.gender][this.age];
    }
  }

  @Watch("age")
  @Watch("gender")
  @Watch("propplan")
  @Watch("priceTable")
  onAgeChanged(newAge: Age, oldAge: Age) {
    this.getPrice();
  }

  mounted() {
    this.plan = this.propplan;
  }

  updated() {
    this.sendInfo();
    this.getPrice();
  }
}
</script>

<style lang="scss" scoped>
.sim-area {
  margin: 10px 0;
  background: #fff;
  padding: 20px;
}
</style>
