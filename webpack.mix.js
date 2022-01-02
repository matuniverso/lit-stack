const mix = require("laravel-mix")

mix
  .js("resources/js/app.js", "public/js")
  .react()
  .postCss("resources/css/app.css", "public/css", [
    require("postcss-import"),
    require("tailwindcss"),
    require("autoprefixer"),
  ])
  .webpackConfig(require("./webpack.config"))
  .disableNotifications()

if (mix.inProduction()) {
  mix.version()
}
