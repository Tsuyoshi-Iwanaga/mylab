<template lang="pug">
.top
  Header
  p プロダクト-就業不能保険(C)
  p
    a(href="../consider/simulation/") シミュレータへ &gt;&gt;
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
export default class Work extends Vue {}
</script>

<style lang="scss" scoped></style>
