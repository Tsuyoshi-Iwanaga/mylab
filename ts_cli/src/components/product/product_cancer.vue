<template lang="pug">
.top
  Header
  p プロダクト-がん保険(C)
  p
    a(href="../../") トップへ &gt;&gt;
  p
    a(href="../../product/") プロダクトトップへ &gt;&gt;
  p
    a(href="../../consider/simulation/") シミュレータへ &gt;&gt;
  div.simulator(style="marginTop: 20px;") 
    p 性別
    p(style="marginBottom: 20px;") 
      input(id="gender-male" type="radio" value="male" name="gender" v-model="simulators[0].gender") 
      label(for="gender-male") 男性
      input(id="gender-female" type="radio" value="female" name="gender" v-model="simulators[0].gender")
      label(for="gender-female") 女性
    p 年齢
    select(v-model="simulators[0].age" style="marginBottom: 20px;")
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
    p プラン
    select(v-model="simulators[0].planList[2]" style="marginBottom: 20px;")
      option(value="01") 01
      option(value="02") 02
      option(value="11") 11
      option(value="12") 12
      option(value="21") 21
      option(value="22") 22
      option(value="none") none
    p 金額
    p(style="marginBottom: 20px;") {{price}}
  Footer
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Header from "../common/header.vue";
import Footer from "../common/footer.vue";
import localStorageIO from "../../functions/localStorageIO";
import fetchData from "../../functions/fetch";
import { Gender, Age, Simulator, priceTableJSON } from "../../type/simulator";

@Component({
  components: {
    Header,
    Footer
  }
})
export default class Cancer extends Vue {
  simulators: Simulator[] = [
    {
      id: 1,
      price: 0,
      gender: Gender.Male,
      age: Age.T7,
      planList: ["01", "01", "01", "01", "01", "01", "01", "01"]
    }
  ];
  priceTable: priceTableJSON = {};
  price: number = 0;

  mounted() {
    fetchData("../../json/priceTable.json")
      .then(response => {
        this.priceTable = response.data as priceTableJSON;
        this.getPrice();
      })
      .catch(error => {
        throw new Error(error);
      });

    if (localStorageIO.getLocalStorage("simulator")) {
      this.simulators = localStorageIO.getLocalStorage(
        "simulator"
      ) as Simulator[];
    }
  }

  getPrice(): void {
    if (this.priceTable["C"]) {
      this.price = this.priceTable["C"][this.simulators[0].planList[2]][
        this.simulators[0].gender
      ][this.simulators[0].age];
    }
  }

  updated() {
    localStorageIO.updateLocalStorage("simulator", this.simulators);
    this.getPrice();
  }
}
</script>

<style lang="scss" scoped></style>
