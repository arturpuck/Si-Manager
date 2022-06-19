const mix = require('laravel-mix');
var path = require('path');
const webpack = require('webpack')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
//mix.vue3("resources/js/test.js', 'public/js");

mix.ts('resources/js/login.ts', 'public/js').vue()
   .ts('resources/js/dashboard.ts', 'public/js').vue()
   .ts('resources/js/movie_creator.ts', 'public/js').vue()
   .sass('resources/sass/login.scss', 'public/css')
   .sass('resources/sass/dashboard.scss', 'public/css')
   .sass('resources/sass/movie_creator.scss', 'public/css')
  .options({ processCssUrls: false })
  .babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import',  "@babel/plugin-transform-modules-commonjs"],
    presets: ["@babel/env"]
  })
  .webpackConfig({
    
    plugins: [
      new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: true,
      }),
    ],
    resolve: {
      alias: {
        '@js': path.resolve('resources/js'),
        '@jscomponents': path.resolve('resources/js/components'),
        '@jsmodules': path.resolve('resources/js/modules'),
        'sass': path.resolve('resources/sass'),
        'sasscomponent': path.resolve('resources/sass/components'),
        '@jscomponents-decoration': path.resolve("resources/js/components/decoration"),
        '@jscomponents-form-controls': path.resolve('resources/js/components/form_controls'),
        '@interfaces': path.resolve('resources/js/interfaces'),
        '@svgicon': path.resolve('resources/js/components/decoration/icons/svg'),
        '@config' : path.resolve('resources/js/config'),
        '@mixins' : path.resolve('resources/js/mixins')
      },
      extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx", ".svg"]
    },

    module: {
      rules: [
        {
          test: /\.tsx?$/,
          loader: "ts-loader",
          options: { appendTsSuffixTo: [/\.vue$/] },
          exclude: /node_modules/
        },

        {
          test: /\.svg$/,
          use: [
            'babel-loader',
            'vue-svg-loader',
          ],
        },

        {
          test: /\.vue$/,
          loader: 'vue-loader',
        }
      ]
    }
  })
