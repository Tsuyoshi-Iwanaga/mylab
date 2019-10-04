<template lang="pug">
.modalOverray(v-if="show" @click.self="hideModal" ref="overray")
  .modalContents
    .selectGender
      p Q1.性別を教えて下さい
      input(id="gender-male" type="radio" value="male" name="gender" v-model="simulators[0].gender") 
      label(for="gender-male") 男性
      input(id="gender-female" type="radio" value="female" name="gender" v-model="simulators[0].gender")
      label(for="gender-female") 女性
    .selectAge
      p Q2.年齢を教えて下さい
      select(v-model="simulators[0].age")
        option(value="0-4") 0-4歳
        option(value="5-9") 5-9歳
        option(value="10-14") 10-14歳
        option(value="15-19") 15-19歳
        option(value="20-24") 20-24歳
        option(value="25-29") 25-29歳
        option(value="30-34") 30-34歳
        option(value="35-39") 35-39歳
        option(value="40-44") 40-44歳
        option(value="45-49") 45-49歳
        option(value="50-54") 50-54歳
        option(value="55-59") 55-59歳
        option(value="60-64") 60-64歳
        option(value="65-69") 65-69歳
        option(value="70-74") 70-74歳
        option(value="75-79") 75-79歳
        option(value="80-84") 80-84歳
        option(value="85-89") 85-89歳
    .button
      a(href="./consider/simulation/") シミュレータへ
</template>

<script lang="ts">
import { Component, Prop, Emit, Watch, Vue } from "vue-property-decorator";
import localStorageIO from "../../functions/localStorageIO";
import { Simulator, Gender, Age } from "../../type/simulator";

@Component
export default class Modal extends Vue {
  show: boolean = true;
  simulators: Simulator[] = [
    {
      id: 1,
      price: 0,
      gender: Gender.Male,
      age: Age.T2,
      planList: []
    }
  ];

  hideModal(ev: Event) {
    this.show = false;
  }

  addSimulator(): void {
    this.simulators.push({
      id: this.simulators.length + 1,
      price: 0,
      gender: Gender.Male,
      age: Age.T7,
      planList: ["01", "01", "01", "01", "01", "01", "01", "01"]
    });
  }

  mounted() {
    if (localStorageIO.getLocalStorage("simulator")) {
      this.simulators = localStorageIO.getLocalStorage(
        "simulator"
      ) as Simulator[];
    } else {
      this.addSimulator();
    }
  }

  updated() {
    localStorageIO.updateLocalStorage("simulator", this.simulators);
  }
}
</script>

<style lang="scss" scoped>
.modalOverray {
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  transition: opacity 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}
.modalContents {
  position: relative;
  width: 100%;
  max-width: 50rem;
  padding: 2rem 3rem;
  background-color: #fff;
  border-radius: 2px;
  transition: all 0.3s ease;
}
.selectGender {
  margin-bottom: 2rem;
}
.selectAge {
  margin-bottom: 2rem;
}
.button {
  background: #e96a27;
  width: 100%;
  max-width: 20rem;
  padding: 2rem;
  color: #fff;
  text-align: center;
  margin: 0 auto;
  transition: opacity 0.5s ease;
}
.button:hover {
  opacity: 0.5;
}
.button a {
  color: #fff;
  text-decoration: none;
}
</style>
