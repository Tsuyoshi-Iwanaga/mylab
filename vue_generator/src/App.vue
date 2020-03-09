<template>
  <div id="app">
    <div id="nav"><router-link to="/">Home</router-link> |</div>
    <router-view />
  </div>
</template>

<style lang="scss">
#app {
  width: 100%;
  max-width: 1000px;
  margin: 0 auto;
}
</style>
