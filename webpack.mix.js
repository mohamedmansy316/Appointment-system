const mix = require('laravel-mix');
mix.options({
    postCss: [
      require('autoprefixer')
    ],
    processCssUrls: false
  });

  mix.js('resources/js/app.js', 'public/js')
   .sass('resources/scss/app.scss' , 'public/css')
   .sass('resources/scss/admin.scss' , 'public/admin/css/style.css')
   .browserSync('http://localhost/appointments-system');
