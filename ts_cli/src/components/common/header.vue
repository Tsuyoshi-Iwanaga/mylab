<template lang="pug">
header.header
  p Header
</template>

<script lang="ts">
import { Component, Prop, Emit, Watch, Vue } from "vue-property-decorator";

@Component
export default class Header extends Vue {}
</script>

<style lang="scss" scoped>
.header {
  min-height: 8rem;
  padding: 1rem;
  background: #0f1269;
  margin-bottom: 2rem;
  color: #fff;
  text-align: center;
}
</style>
