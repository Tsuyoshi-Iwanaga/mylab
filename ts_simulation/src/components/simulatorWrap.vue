<template>
  <div class="p-sim_wrap">
    <h2>Simulator</h2>
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
    <div>{{priceTable}}</div>
    <SimulatorA :gender="gender" :age="age" :priceTable="priceTable" @getPlan="handler($event)"></SimulatorA>
    <button>削除</button>
  </div>
</template>

<script lang="ts">
import {Component, Vue} from "vue-property-decorator";
import fetchData from '../fetch';
import SimulatorA from "./simulatorA.vue";

enum Gender {
  Male='male',
  Female='female'
}
enum Age {
  T1='0-4',
  T2='5-9',
  T3='10-14',
  T4='15-19',
  T5='20-24',
  T6='25-29',
  T7='30-34',
  T8='35-39',
  T9='40-44',
  T10='45-49',
  T11='50-54',
  T12='55-59',
  T13='60-64',
  T14='65-69',
  T15='70-74',
  T16='75-79'
}

interface TypeInfo {
  id: number
  plan: string
  price: number
}

@Component({
  components: {
    SimulatorA
  }
})
export default class SimulatorWrap extends Vue {
  gender: Gender = Gender.Male
  age: Age = Age.T7
  planList: string[] = ['A01', 'B01', 'C01', 'D01', 'E01', 'F01', 'G01', 'H01']
  planPriceList: number[] = [0, 0, 0, 0, 0, 0, 0, 0]
  priceTable: object = {}

  handler(event:TypeInfo) {
    let index = event.id
    this.$set(this.planList, index, event.plan);
    this.$set(this.planPriceList, index, event.price);
  }

  get PriceSum() {
    const sum = this.planPriceList.reduce((a:number, b:number):number => { return a + b});
    return sum;
  }

  get PlanList() {
    const list = this.planList.map((item:string):string => { return item});
    return list.join("/");
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
  max-width: 900px;
  margin: 0 auto;
  background: #eee;
  padding: 20px;
}
</style>