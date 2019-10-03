<template lang="pug">
.top
  Header
  p トップページです。
  p
    a(href="./simulation/") シミュレータへ
  Modal
    p モーダル中身
  Footer
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Header from "../common/header.vue";
import Footer from "../common/footer.vue";
import Modal from "./modal.vue";

@Component({
  components: {
    Header,
    Footer,
    Modal
  }
})
export default class Index extends Vue {}
</script>

<style lang="scss" scoped>
.top {
  color: $BASECOLOR;
}
</style>
