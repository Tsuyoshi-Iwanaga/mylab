<template>
  <div class="p-sim_container">
    <SimulatorWrap
      v-for="simulator in simulators"
      :key="simulator.id"
      :simNum="simulator.id"
      @removeSimulator="removeHandler($event)"
      @sumCalcPrice="updateSimulatorsInfo($event)"
    >
    </SimulatorWrap>
    <p>
      合計値:<span class="p-sim_allPriceSum">￥{{ simulatorsSumPrice }}</span
      >/{{ simulators }}
    </p>
    <button v-show="this.simulators.length < 5" @click="addSimulator">
      シミュレータ追加
    </button>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import SimulatorWrap from "./simulatorWrap.vue";
import { Gender, Age, SimulatorInfo } from "./simulator";

interface Simulator {
  id: number;
  price: number;
  gender: Gender;
  age: Age;
  planList: string[];
}

@Component({
  components: {
    SimulatorWrap
  }
})
export default class SimulatorContainer extends Vue {
  simulatorsSumPrice: number = 0;
  simulators: Simulator[] = [
    {
      id: 1,
      price: 0,
      gender: Gender.Male,
      age: Age.T7,
      planList: ["01", "01", "01", "01", "01", "01", "01", "01"]
    }
  ];

  addSimulator(): void {
    if (this.simulators.length < 5) {
      this.simulators.push({
        id: this.simulators.length + 1,
        price: 0,
        gender: Gender.Male,
        age: Age.T7,
        planList: ["01", "01", "01", "01", "01", "01", "01", "01"]
      });
    }
  }

  removeHandler(event: SimulatorInfo): void {
    let index: number = 0;
    this.simulators.forEach((v, i) => {
      if (v.id === event.id) {
        index = i;
      }
    });
    this.simulators.splice(index, 1);
  }

  updateSimulatorsInfo(event: SimulatorInfo): void {
    this.simulators.forEach((v, i): void => {
      if (v.id === event.id) {
        v.price = event.price;
        v.gender = event.gender;
        v.age = event.age;
        v.planList = event.planList;
      }
    });
  }

  calcSumCost(): void {
    let sumCost = 0;
    this.simulators.forEach((v, i): void => {
      sumCost += v.price;
    });
    this.simulatorsSumPrice = sumCost;
  }

  updateLocalStorage(key: string): void {
    localStorage.setItem(key, JSON.stringify(this.simulators));
  }

  getLocalStorage(key: string): void {
    let stringData: string | null = localStorage.getItem(key);
    if (stringData) {
      this.simulators = JSON.parse(stringData);
    }
  }

  mounted() {
    this.getLocalStorage("simulator");
  }

  updated() {
    this.calcSumCost();
    this.updateLocalStorage("simulator");
  }
}
</script>

<style lang="scss" scoped>
.p-sim_container {
  width: 100%;
  max-width: 900px;
  margin: 0 auto 20px;
}
.p-sim_allPriceSum {
  font-weight: bold;
  color: #f00;
}
</style>
