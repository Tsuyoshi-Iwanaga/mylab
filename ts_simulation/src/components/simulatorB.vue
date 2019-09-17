<template>
  <div class="sim-area">
    <h3>医療保険(B)</h3>
    <p>プラン:B{{plan}}</p>
    <p>値段:{{price}}</p>
    <select v-model="plan">
      <option v-show="(option.show)" v-for="option in options" :value="option.name" :key="option.id">{{ option.name }}</option>
    </select>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Emit, Watch, Vue} from "vue-property-decorator";
  import {Gender, Age, OptionItem, PlanB} from './simulator';

  @Component
  export default class SimulatorB extends Vue {
    //data
    price: number = 0
    plan: string = '01'
    options: OptionItem[] =  [
      { id: 1, name: '01', show: true},
      { id: 2, name: '02', show: true},
      { id: 3, name: '11', show: true},
      { id: 4, name: '12', show: true},
      { id: 5, name: '01W', show: true},
      { id: 6, name: '02W', show: true},
      { id: 7, name: '11W', show: true},
      { id: 8, name: '12W', show: true},
      { id: 9, name: 'none', show: true},
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
      this.price = this.priceTable["B"][this.plan][this.gender][this.age]
    }

    updateGender():void {
      if(this.gender === Gender.Male) {
        //女性のみパターンを選択時、男性に切り替える時はWを削除したプランとする
        if(this.plan.indexOf('W') > 0) {
          this.plan = this.plan.slice(0, -1);
        }
        this.options.forEach((v) => {
          if(v.name.indexOf('W') > 0) {
            v.show = false
          } 
        });
      } else {
        this.options.forEach((v) => {
          v.show = true
        });
      }
    }

    @Watch('age')
    @Watch('gender')
    @Watch('priceTable')
    onAgeChanged(newAge:Age, oldAge:Age) {
      this.updateGender();
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