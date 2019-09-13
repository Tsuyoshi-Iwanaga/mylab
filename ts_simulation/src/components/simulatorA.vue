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
    None='なし'
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
      { id: 2, name: 'なし'},
    ]

    //Props
    @Prop({})
    gender!: string;
    @Prop({})
    age!: string;

    //Emit
    @Emit('getPlan')
    sendInfo() {
      return {
        id: 0,
        plan: this.plan,
        price: this.price,
      }
    }

    //LifeCycle
    mounted() {
      this.sendInfo()
    }
    updated() {
      this.sendInfo()
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