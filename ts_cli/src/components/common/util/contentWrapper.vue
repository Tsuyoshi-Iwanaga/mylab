<template lang="pug">
.contentWrapper
  slot
</template>

<script lang="ts">
import { Component, Prop, Emit, Watch, Vue } from "vue-property-decorator";

@Component
export class ContentWrapper extends Vue {}
</script>

<style lang="scss" scoped>
.contentWrapper {
  width: 100%;
  margin: 0 auto;
  max-width: $CONTENTWIDTH;
}
</style>
