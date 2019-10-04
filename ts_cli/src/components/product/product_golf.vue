<template lang="pug">
.top
  Header
  p プロダクト-ホールインワン保険(H)
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
export default class Golf extends Vue {}
</script>

<style lang="scss" scoped></style>
