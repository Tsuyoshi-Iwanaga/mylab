<template>
  <p>{{ greeting }} World!</p>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator";

  @Component
  export default class SimulatorWrap extends Vue {
    greeting: string = 'hogehoge'
  }
</script>

<style lang="scss" scoped>
p {
  font-size: 2em;
  text-align: center;
  &.hoge{
    font-size: 0;
  }
}
</style>