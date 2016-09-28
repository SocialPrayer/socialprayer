var elixir = require('laravel-elixir'),
    gulp = require('gulp');

elixir(function(mix) {
    mix.sass('app.scss');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap'); 
    mix.copy('bower_components/jquery.ns-autogrow/dist/jquery.ns-autogrow.min.js','public/js/vendor/jquery.ns-autogrow.js');
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js','public/js/vendor/bootstrap/tooltip.js');
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap/popover.js','public/js/vendor/bootstrap/popover.js');
});