<template>
  <div class="sim-area">
    <h3>プランB</h3>
    <p>プラン:{{plan}}</p>
    <p>値段:{{price}}</p>
    <select v-model="plan">
      <option v-for="option in options" :value="option.name" :key="option.id">{{ option.name }}</option>
    </select>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Emit, Watch, Vue} from "vue-property-decorator";
  import {Gender, Age, OptionItem, PlanA} from './simulator';

  @Component
  export default class SimulatorB extends Vue {
    //data
    price: number = 0
    plan: string = 'A01'
    options: OptionItem[] =  [
      { id: 1, name: 'A01'},
      { id: 2, name: 'none'},
    ]

    //Props
    @Prop({})
    gender!: Gender;
    @Prop({})
    age!: Age;
    @Prop({})
    priceTable!: any;

    //Emit
    @Emit('getPlan')
    sendInfo() {
      return {
        id: 1,
        plan: this.plan,
        price: this.price,
      }
    }

    //method
    getPrice():void {
      this.price = this.priceTable[this.plan][this.gender][this.age]
    }

    @Watch('age')
    @Watch('gender')
    onAgeChanged(newAge:Age, oldAge:Age) {
      this.getPrice();
    }

    //LifeCycle
    // mounted() {
    //   this.sendInfo()
    // }
    updated() {
      this.sendInfo()
      this.getPrice()
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