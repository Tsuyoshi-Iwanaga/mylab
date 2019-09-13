<template>
  <p>{{ hoge }}</p>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator";

  @Component
  export default class XXX extends Vue {
    hoge: string = 'dummy'
  }
</script>

<style lang="scss" scoped>
.selector01 {
  text-align: center;
  &.selector02{
    font-size: 0;
  }
}
</style>