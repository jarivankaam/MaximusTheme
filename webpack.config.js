const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  entry: {
    style: "./assets/scss/style.scss",
  },

  output: {
    // Output JS to theme root (will also create style.js — harmless)
    path: path.resolve(__dirname, "./"),
    filename: "[name].js",
    clean: false, // IMPORTANT: do not wipe the theme folder
  },

  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
      },
    ],
  },

  plugins: [
    new MiniCssExtractPlugin({
      // This writes style.css beside functions.php, index.php, etc.
      filename: "style.css",
    }),
  ],

  mode: "development",
};
