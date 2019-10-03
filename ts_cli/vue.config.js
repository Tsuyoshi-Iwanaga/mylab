module.exports = {
  css: {
    loaderOptions: {
      sass: {
        data: `@import "src/assets/common/scss/abstract.scss";`
      }
    }
  },
  pages: {
    top: {
      entry: "src/pages/top/top.ts",
      template: "src/pages/top/index.pug",
      filename: "index.html"
    },
    simulation: {
      entry: "src/pages/simulation/simulation.ts",
      template: "src/pages/simulation/index.pug",
      filename: "simulation/index.html"
    }
  }
};
