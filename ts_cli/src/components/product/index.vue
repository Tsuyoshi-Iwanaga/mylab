<template lang="pug">
.top
  Header
  p プロダクトトップ
  p
    a(href="/") トップへ &gt;&gt;
  p
    a(href="/consider/simulation/") シミュレーターへ &gt;&gt;
  p
    a(href="/product/medical/") 傷害保険(A) &gt;&gt;
  p
    span 医療保険(B)
  p
    a(href="/product/cancer/") がん保険(C) &gt;&gt;
  p
    span 介護保険(D)
  p
    span 就業不能保険(E)
  p
    span 個人賠償責任保険(F)
  p
    span 携行品損害保険(G)
  p
    span ホールインワン保険(H)
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
