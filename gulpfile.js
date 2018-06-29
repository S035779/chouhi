const elixir = require('cakephp3-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Extensions
 |--------------------------------------------------------------------------
 |
 | Elixir provides several extensions which bring new functionality to Elixir.
 | A couple of examples have been included below to get you started.
 | You can use any extension made for the most recent version of Elixir 6.
 | Feel free to try out different extensions!
 | Please report any problems to: https://github.com/pfuri/cakephp-elixir/issues
 |
 */
//require('laravel-elixir-del');
//require('laravel-elixir-webpack-official');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir(mix => {
  // Example
  //mix.del(["webroot/build", "webroot/css", "webroot/js"])
  //.sass('default.scss').version('css/default.css')
  //.webpack('default.js').version('js/default.js');
  mix
    .sass('common.scss',                  'resources/assets/build/css')
    .sass('dashboard.scss',               'resources/assets/build/css')
    .sass('bootstrap-datepicker3.scss',   'resources/assets/build/css')
    .sass('signin.scss',                  'resources/assets/build/css')
    .styles([
      '../build/css/bootstrap-datepicker3.css'
    , '../build/css/dashboard.css'
    , '../build/css/common.css'
    ], 'webroot/css/watchnote.css' )
    .styles([
      '../build/css/signin.css'
    , '../build/css/common.css'
    ], 'webroot/css/signin.css'    )
    .scripts([
      'bootstrap-datepicker.min.js'
    , 'bootstrap-datepicker.ja.min.js'
    , 'holder.min.js'
    ], 'webroot/js/watchnote.js'   )
    .version([
      'css/watchnote.css'
    , 'css/signin.css'
    , 'js/watchnote.js'
    ])
    //.browserSync({ proxy: 'localhost' })
  ;
});
