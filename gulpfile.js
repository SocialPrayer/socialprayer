var elixir = require('laravel-elixir'),
    gulp = require('gulp');

elixir(function(mix) {
    mix.sass('app.scss');
    mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.js');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap'); 
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/js/bootstrap.js');
    mix.copy('node_modules/jquery.ns-autogrow/dist/jquery.ns-autogrow.min.js','public/js/vendor/jquery.ns-autogrow.js');
});