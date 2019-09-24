<template>
  <div class="sim-area">
    <h3>携行品損害保険(G)</h3>
    <p>プラン:G{{plan}}</p>
    <p>値段:{{price}}</p>
    <select v-model="plan">
      <option v-for="option in options" :value="option.name" :key="option.id">{{ option.name }}</option>
    </select>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Emit, Watch, Vue} from "vue-property-decorator";
  import {Gender, Age, OptionItem, PlanG, priceTableJSON} from './simulator';

  @Component
  export default class SimulatorG extends Vue {
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
    propPlan!: string
    @Prop({})
    priceTable!: priceTableJSON;

    //Emit
    @Emit('getPlan')
    sendInfo() {
      return {
        id: 6,
        plan: this.plan,
        price: this.price,
      }
    }

    //method
    getPrice():void {
      if(this.priceTable["G"]) {
        this.price = this.priceTable["G"][this.plan][this.gender][this.age]
      }
    }

    @Watch('age')
    @Watch('gender')
    @Watch('propPlan')
    @Watch('priceTable')
    onAgeChanged(newAge:Age, oldAge:Age) {
      this.getPrice();
    }

    mounted() {
      this.plan = this.propPlan
      this.getPrice()
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