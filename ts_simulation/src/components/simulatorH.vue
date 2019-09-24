<template>
  <div class="sim-area">
    <h3>ホールインワン保険(H)</h3>
    <p>プラン:H{{plan}}</p>
    <p>値段:{{price}}</p>
    <select v-model="plan">
      <option v-for="option in options" :value="option.name" :key="option.id">{{ option.name }}</option>
    </select>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Emit, Watch, Vue} from "vue-property-decorator";
  import {Gender, Age, OptionItem, PlanH} from './simulator';

  @Component
  export default class SimulatorH extends Vue {
    //data
    price: number = 0
    plan: string = '01'
    options: OptionItem[] =  [
      { id: 1, name: '01', show: true},
      { id: 2, name: 'none', show: true},
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
        id: 7,
        plan: this.plan,
        price: this.price,
      }
    }

    //method
    getPrice():void {
      if(this.priceTable["H"]) {
        this.price = this.priceTable["H"][this.plan][this.gender][this.age]
      }
    }

    @Watch('age')
    @Watch('gender')
    @Watch('priceTable')
    onAgeChanged(newAge:Age, oldAge:Age) {
      this.getPrice();
    }

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