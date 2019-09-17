<template>
  <div class="p-sim_wrap">
    <h2>Simulator No.{{simNum}}</h2>
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
        </select>
      </div>
    </div>
    <div>年齢:{{ age }}歳</div>
    <div>性別:{{ gender === 'male' ? '男性' : '女性'  }}</div>
    <div>プラン:{{PlanList}}</div>
    <div>合計金額:{{PriceSum}}</div>
    <SimulatorA :gender="gender" :age="age" :priceTable="priceTable" @getPlan="handler($event)"></SimulatorA>
    <SimulatorB :gender="gender" :age="age" :priceTable="priceTable" @getPlan="handler($event)"></SimulatorB>
    <button v-show="!(simNum === 1)" @click="removeSimulator">削除</button>
  </div>
</template>

<script lang="ts">
import {Component, Vue, Prop, Emit} from "vue-property-decorator";
import fetchData from '../fetch';
import SimulatorA from "./simulatorA.vue";
import SimulatorB from "./simulatorB.vue";
import {Gender, Age, TypeInfo} from './simulator';

@Component({
  components: {
    SimulatorA,SimulatorB
  }
})
export default class SimulatorWrap extends Vue {
  gender: Gender = Gender.Male
  age: Age = Age.T7
  planList: string[] = ['A01', 'B01', 'C01', 'D01', 'E01', 'F01', 'G01', 'H01']
  planPriceList: number[] = [0, 0, 0, 0, 0, 0, 0, 0]
  priceTable: any = {}

  @Prop({})
  simNum!: number;

  //Emit
  @Emit('removeSimulator')
  sendInfo() {
    return {
      id: this.simNum
    }
  }

  get PriceSum() {
    const sum = this.planPriceList.reduce((a:number, b:number):number => { return a + b});
    return sum;
  }

  get PlanList() {
    const list = this.planList.map((item:string):string => { return item});
    return list.join("/");
  }

  handler(event:TypeInfo) {
    let index = event.id
    this.$set(this.planList, index, event.plan);
    this.$set(this.planPriceList, index, event.price);
  }

  removeSimulator() {
    this.sendInfo()
  }

  created() {
    fetchData('json/priceTable.json').then((response) => {
      this.priceTable = response.data
    }).catch((error) =>{
      throw new Error(error);
    })
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