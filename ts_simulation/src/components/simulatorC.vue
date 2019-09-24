<template>
  <div class="sim-area">
    <h3>がん保険(C)</h3>
    <p>プラン:C{{plan}}</p>
    <p>値段:{{price}}</p>
    <select v-model="plan">
      <option v-for="option in options" :value="option.name" :key="option.id">{{ option.name }}</option>
    </select>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Emit, Watch, Vue} from "vue-property-decorator";
  import {Gender, Age, OptionItem, PlanC, priceTableJSON} from './simulator';

  @Component
  export default class SimulatorC extends Vue {
    //data
    price: number = 0
    plan: string = '01'
    options: OptionItem[] =  [
      { id: 1, name: '01', show: true},
      { id: 2, name: '02', show: true},
      { id: 3, name: '11', show: true},
      { id: 4, name: '12', show: true},
      { id: 5, name: '21', show: true},
      { id: 6, name: '22', show: true},
      { id: 7, name: 'none', show: true},
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
        id: 2,
        plan: this.plan,
        price: this.price,
      }
    }

    //method
    getPrice():void {
      if(this.priceTable["C"]) {
        this.price = this.priceTable["C"][this.plan][this.gender][this.age]
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