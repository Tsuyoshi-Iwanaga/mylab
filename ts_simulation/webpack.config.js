const path = require('path');

// vue-loader@15 から必要
const VueLoaderPlugin = require('vue-loader/lib/plugin');

// 補完が効きます！
/** @type import('webpack').Configuration */
const config = {
  mode: 'development',
  resolve: {
    // '.jsx' と '.tsx' を追加することが重要
    extensions: ['.js', '.jsx', '.ts', '.tsx', '.vue', '.json'],
    // エイリアス設定が必要
    alias: {
      vue$: 'vue/dist/vue.esm.js',
    },
  },
  entry: './src/index.ts',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'simulator.js',
  },
  module: {
    rules: [
      {
        // '.ts', '.tsx' は 'ts-loader' に
        test: /\.(ts|tsx)$/,
        exclude: /node_modules/,
        loader: 'ts-loader',
        // 超重要オプション！
        options: {
          appendTsSuffixTo: [/\.vue$/],
        },
      },
      {
        // 単一ファイルコンポーネント
        test: /\.vue$/,
        exclude: /node_modules/,
        loader: 'vue-loader',
      },
      {
        test: /\.css$/,
        use: [
          "vue-style-loader",
          "css-loader",
        ],
      },
      {
        test: /\.scss$/,
        use: [
          "vue-style-loader",
          {
            loader: "css-loader",
            options: { sourceMap: true },
          },
          {
            loader: "sass-loader",
            options: { sourceMap: true },
          },
        ],
      },
    ],
  },
  plugins: [new VueLoaderPlugin()],
};

module.exports = config;