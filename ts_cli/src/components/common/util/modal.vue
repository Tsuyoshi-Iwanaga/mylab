<template lang="pug">
.modalOverray(v-if="show" @click.self="hideModal" ref="overray")
  .modalContents
    slot
</template>

<script lang="ts">
import { Component, Prop, Emit, Watch, Vue } from "vue-property-decorator";
import { Simulator, Gender, Age } from "../../../type/simulator";

@Component
export default class Modal extends Vue {
  show: boolean = true;

  hideModal(ev: Event) {
    this.show = false;
  }
}
</script>

<style lang="scss" scoped>
.modalOverray {
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  transition: opacity 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}
.modalContents {
  position: relative;
  width: 100%;
  max-width: 50rem;
  padding: 2rem 3rem;
  background-color: #fff;
  border-radius: 2px;
  transition: all 0.3s ease;
}
</style>
