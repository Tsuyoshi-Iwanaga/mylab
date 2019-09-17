<template>
  <div class="p-sim_container">
    <SimulatorWrap v-for="simulator in simulators" :key="simulator.id" :simNum="simulator.id" @removeSimulator="removeHandler($event)"></SimulatorWrap>
    <button @click="addSimulator">シミュレータ追加</button>
  </div>
</template>

<script lang="ts">
import {Component, Vue} from "vue-property-decorator";
import SimulatorWrap from "./simulatorWrap.vue";
import {Gender, Age, TypeInfo} from './simulator';

interface Simulator {
  id: number;
}

@Component({
  components: {
    SimulatorWrap
  }
})
export default class SimulatorContainer extends Vue {
  simulatorsLength = 1;
  simulators:Simulator[] = [
    {id: 1}
  ]

  addSimulator():void {
    if(this.simulators.length < 5) {
      this.simulators.push({id: this.simulatorsLength + 1});
      this.simulatorsLength++;
    }
  }

  removeHandler(event:TypeInfo):void {
    let index:number = 0;
    this.simulators.forEach((v, i) => {
      if(v.id === event.id){
        index = i;
      }
    })
    this.simulators.splice(index, 1)
  }
}
</script>

<style lang="scss" scoped>
.p-sim_container {
  width: 100%;
  max-width: 900px;
  margin: 0 auto 20px;
}
</style>