<template lang="pug">
header.header
  p Footer
</template>

<script lang="ts">
import { Component, Prop, Emit, Watch, Vue } from "vue-property-decorator";

@Component
export default class Footer extends Vue {}
</script>

<style lang="scss" scoped>
.header {
  min-height: 8rem;
  padding: 1rem;
  background: #666;
  color: #fff;
  text-align: center;
}
</style>
