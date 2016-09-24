var elixir = require('laravel-elixir'),
    gulp = require('gulp');

elixir(function(mix) {
    mix.sass('app.scss');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap'); 

});