/* eslint-disable @typescript-eslint/no-var-requires */

// comment this snippet to disable purgecss
const purgecss = require("@fullhuman/postcss-purgecss");

module.exports = {
  plugins: [
    purgecss({
      content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/views/**/*.vue",
        "./resources/scripts/**/*.js",
        "./resources/scripts/**/*.ts",
      ],
    }),
  ],
};
