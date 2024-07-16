const mix = require('laravel-mix');

mix.sass('public/scss/theme.scss', 'public/css')
   .sass('public/scss/user.scss', 'public/css')
   .setPublicPath('public');
