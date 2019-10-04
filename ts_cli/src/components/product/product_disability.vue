<template lang="pug">
.top
  Header
  p プロダクト-障害保険(E)
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
export default class Disability extends Vue {}
</script>

<style lang="scss" scoped></style>
