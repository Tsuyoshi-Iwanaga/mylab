<template lang="pug">
.top
  Header
  p プロダクト-携行品障害保険(G)
  p
    a(href="../simulation/") シミュレータへ &gt;&gt;
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
export default class CarryingGoods extends Vue {}
</script>

<style lang="scss" scoped></style>
