<template>
  <div class="sim-area">
    <h3>プランA商品</h3>
    <p>プラン:{{plan}}</p>
    <p>値段:{{price}}</p>
    <select v-model="plan">
      <option v-for="option in options" :value="option.name" :key="option.id">{{ option.name }}</option>
    </select>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Emit, Vue} from "vue-property-decorator";

  //型定義
  enum PlanA {
    A01='A01',
    None='none'
  }

  interface OptionItem {
    id: number;
    name: string;
  }

  @Component
  export default class SimulatorA extends Vue {
    //data
    price: number = 1000
    plan: string = 'A01'
    options: OptionItem[] =  [
      { id: 1, name: 'A01'},
      { id: 2, name: 'none'},
    ]

    //Props
    @Prop({})
    gender!: string;
    @Prop({})
    age!: string;
    @Prop({})
    priceTable!: object;

    //Emit
    @Emit('getPlan')
    sendInfo() {
      return {
        id: 0,
        plan: this.plan,
        price: this.price,
      }
    }

    //method
    getPrice(gender:string, age:string, type:string) {
      let cost:number = 0
      console.log(gender, age, type)
      cost = this.priceTable[type][gender][age]
      this.price = cost
    }

    //LifeCycle
    mounted() {
      this.sendInfo()
    }
    updated() {
      this.sendInfo()
      this.getPrice(this.gender, this.age, this.plan)
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