<template>
  <div class="p-sim_wrap">
    <h2>Simulator No.{{simulator.id}}</h2>
    <div>
      <div class="inputArea">
        <select v-model="gender">
          <option value="male">男性</option>
          <option value="female">女性</option>
        </select>
        <select v-model="age">
          <option value="0-4">0-4歳</option>
          <option value="5-9">5-9歳</option>
          <option value="10-14">10-14歳</option>
          <option value="15-19">15-19歳</option>
          <option value="20-24">20-24歳</option>
          <option value="25-29">25-29歳</option>
          <option value="30-34">30-34歳</option>
          <option value="35-39">35-39歳</option>
          <option value="40-44">40-44歳</option>
          <option value="45-49">45-49歳</option>
          <option value="50-54">50-54歳</option>
          <option value="55-59">55-59歳</option>
          <option value="60-64">60-64歳</option>
          <option value="65-69">65-69歳</option>
          <option value="70-74">70-74歳</option>
          <option value="75-79">75-79歳</option>
          <option value="80-84">80-84歳</option>
          <option value="85-89">85-89歳</option>
        </select>
      </div>
    </div>
    <div>年齢: {{ age }}歳</div>
    <div>性別: {{ gender === 'male' ? '男性' : '女性'  }}</div>
    <div>プラン: {{PlanList}}</div>
    <div>合計金額: ￥{{PriceSum}}</div>
    <SimulatorA :gender="gender" :age="age" :priceTable="priceTable" :prop-plan="planList[0]" @getPlan="handler($event)"></SimulatorA>
    <SimulatorB :gender="gender" :age="age" :priceTable="priceTable" :prop-plan="planList[1]" @getPlan="handler($event)"></SimulatorB>
    <SimulatorC :gender="gender" :age="age" :priceTable="priceTable" :prop-plan="planList[2]" @getPlan="handler($event)"></SimulatorC>
    <SimulatorD :gender="gender" :age="age" :priceTable="priceTable" :prop-plan="planList[3]" @getPlan="handler($event)"></SimulatorD>
    <SimulatorE :gender="gender" :age="age" :priceTable="priceTable" :prop-plan="planList[4]" @getPlan="handler($event)"></SimulatorE>
    <SimulatorF :gender="gender" :age="age" :priceTable="priceTable" :prop-plan="planList[5]" @getPlan="handler($event)"></SimulatorF>
    <SimulatorG :gender="gender" :age="age" :priceTable="priceTable" :prop-plan="planList[6]" @getPlan="handler($event)"></SimulatorG>
    <SimulatorH :gender="gender" :age="age" :priceTable="priceTable" :prop-plan="planList[7]" @getPlan="handler($event)"></SimulatorH>
    <button v-show="!(simulator.id === 1)" @click="removeSimulator">削除</button>
  </div>
</template>

<script lang="ts">
import {Component, Vue, Prop, Emit, Watch} from "vue-property-decorator";
import fetchData from '../fetch';
import SimulatorA from "./simulatorA.vue";
import SimulatorB from "./simulatorB.vue";
import SimulatorC from "./simulatorC.vue";
import SimulatorD from "./simulatorD.vue";
import SimulatorE from "./simulatorE.vue";
import SimulatorF from "./simulatorF.vue";
import SimulatorG from "./simulatorG.vue";
import SimulatorH from "./simulatorH.vue";
import {Gender, Age, TypeInfo, Simulator, priceTableJSON} from './simulator';

@Component({
  components: {
    SimulatorA, SimulatorB, SimulatorC, SimulatorD, SimulatorE, SimulatorF, SimulatorG, SimulatorH
  }
})
export default class SimulatorWrap extends Vue {
  gender: Gender = Gender.Male
  age: Age = Age.T7
  planList: string[] = ['01', '01', '01', '01', '01', '01', '01']
  planPriceList: number[] = [0, 0, 0, 0, 0, 0, 0, 0]
  priceTable: priceTableJSON = {}

  @Prop({})
  simulator!: Simulator;
  @Prop({})
  table!: priceTableJSON;

  @Watch('table')
  hoge() {
    this.priceTable = this.table;
  }

  //Emit
  @Emit('removeSimulator')
  removeSimulator() {
    return {
      id: this.simulator.id
    }
  }
  @Emit('sumCalcPrice')
  sumCalcPrice() {
    return {
      id: this.simulator.id,
      price: this.PriceSum,
      gender: this.gender,
      age: this.age,
      planList: this.planList
    }
  }

  get PriceSum():number {
    const sum = this.planPriceList.reduce((a:number, b:number):number => { return a + b});
    return sum;
  }

  get PlanList():string {
    const text = `A:${this.planList[0]}/B:${this.planList[1]}/C:${this.planList[2]}/D:${this.planList[3]}/E:${this.planList[4]}/F:${this.planList[5]}/G:${this.planList[6]}/H:${this.planList[7]}`
    return text;
  }

  handler(event:TypeInfo) {
    let index = event.id
    this.$set(this.planList, index, event.plan);
    this.$set(this.planPriceList, index, event.price);
  }

  created() {
    this.gender = this.simulator.gender
    this.age = this.simulator.age
    this.planList = this.simulator.planList
    this.priceTable = this.table
  }

  updated() {
    this.sumCalcPrice();
  }
}
</script>

<style lang="scss" scoped>
.inputArea {
  margin-bottom: 20px;
}
.p-sim_wrap {
  width: 100%;
  background: #eee;
  padding: 20px;
  margin-bottom: 10px;
}
</style>