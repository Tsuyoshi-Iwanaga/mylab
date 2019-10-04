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
    productTop: {
      entry: "src/pages/product/index.ts",
      template: "src/pages/product/index.pug",
      filename: "product/index.html"
    },
    product_medical: {
      entry: "src/pages/product/medical.ts",
      template: "src/pages/product/medical.pug",
      filename: "product/medical/index.html"
    },
    product_cancer: {
      entry: "src/pages/product/cancer.ts",
      template: "src/pages/product/cancer.pug",
      filename: "product/cancer/index.html"
    },
    simulation: {
      entry: "src/pages/consider/simulation/index.ts",
      template: "src/pages/consider/simulation/index.pug",
      filename: "consider/simulation/index.html"
    },
    life_event: {
      entry: "src/pages/consider/lifeevent/index.ts",
      template: "src/pages/consider/lifeevent/index.pug",
      filename: "consider/lifeevent/index.html"
    }
  }
};
