<template lang="pug">
.top
  Header
  p トップページです。
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
export default class Index extends Vue {}
</script>

<style lang="scss" scoped></style>
