<template lang="pug">
.top
  Header
  p プロダクト-介護保険(F)
  p
    a(href="../../consider/simulation/") シミュレータへ &gt;&gt;
  Footer
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Header from "../common/header.vue";
import Footer from "../common/footer.vue";

@Component({
  components: {
    Header,
    Footer
  }
})
export default class Nursing extends Vue {}
</script>

<style lang="scss" scoped></style>
