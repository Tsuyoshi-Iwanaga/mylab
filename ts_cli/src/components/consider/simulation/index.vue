<template lang="pug">
.top
  Header
  SimulatorContainer
  Footer
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Header from "../../common/header.vue";
import Footer from "../../common/footer.vue";
import SimulatorContainer from "./simulatorContainer.vue";

@Component({
  components: {
    Header,
    Footer,
    SimulatorContainer
  }
})
export default class Index extends Vue {}
</script>

<style lang="scss" scoped></style>
