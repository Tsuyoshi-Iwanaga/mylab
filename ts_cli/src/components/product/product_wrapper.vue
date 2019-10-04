<template lang="pug">
.top
  Header
  p プロダクト-医療保険(A)
  p
    a(href="../consider/simulation/") シミュレータへ &gt;&gt;
  Footer
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component({
  components: {}
})
export default class Index extends Vue {}
</script>

<style lang="scss" scoped></style>
