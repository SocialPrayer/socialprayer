var elixir = require('laravel-elixir'),
    gulp = require('gulp');

require('laravel-elixir-webpack-official');
require('laravel-elixir-vue-2');

elixir(function(mix) {
    mix.sass('app.scss');
    mix.webpack('app.js');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap'); 
    mix.copy('node_modules/jquery.ns-autogrow/dist/jquery.ns-autogrow.min.js','public/js/vendor/jquery.ns-autogrow.js');
    mix.copy('node_modules/moment/moment.js','public/js/vendor/moment.js');
});