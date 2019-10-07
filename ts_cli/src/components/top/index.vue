<template lang="pug">
.top
  Header
  p トップページです。
  p
    a(href="./product/") 商品紹介へ &gt;&gt;
  p
    a(href="./consider/simulation/") シミュレータへ &gt;&gt;
  p
    a(href="./consider/lifeevent/") ライフイベントへ &gt;&gt;
  Modal
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
  Footer
</template>

<script lang="ts">
import { Component, Prop, Emit, Watch, Vue } from "vue-property-decorator";
import localStorageIO from "../../functions/localStorageIO";
import Header from "../common/header.vue";
import Footer from "../common/footer.vue";
import Modal from "../common/util/modal.vue";
import { Simulator, Gender, Age } from "../../type/simulator";

@Component({
  components: {
    Header,
    Footer,
    Modal
  }
})
export default class Index extends Vue {
  simulators: Simulator[] = [
    {
      id: 1,
      price: 0,
      gender: Gender.Male,
      age: Age.T2,
      planList: []
    }
  ];

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
.top {
  color: $BASECOLOR;
  @include DOWN() {
    color: #f00;
  }
}
</style>
