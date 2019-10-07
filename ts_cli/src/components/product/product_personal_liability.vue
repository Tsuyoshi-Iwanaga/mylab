<template lang="pug">
.top
  Header
  p プロダクト-個人賠償責任保険(D)
  p
    a(href="../../consider/product/") シミュレータへ &gt;&gt;
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
export default class PersonalLiability extends Vue {}
</script>

<style lang="scss" scoped></style>
