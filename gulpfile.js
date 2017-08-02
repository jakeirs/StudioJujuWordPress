var gulp = require('gulp'),
sass = require('gulp-sass'),
pug = require('gulp-pug'),
browserSync = require('browser-sync'),
webpack = require('webpack'),
fs = require('fs-extra'),
gulpLoadPlugins = require('gulp-load-plugins');

const $ = gulpLoadPlugins(),
wordpressPath = 'C:\\xampp\\htdocs\\wordpress\\wp-content\\themes\\JujuStudioTheme';




// delete build directory
gulp.task('clean', function() {
  fs.removeSync(wordpressPath);
  console.log("Success deleted");
});


//copy other stuff like library .php and images
gulp.task('copyOtherStuff', function(){
  return gulp.src(["./dev/**/img/*", "./dev/**/*.php", "./dev/*.{css,jpg,jpeg,png}"])
    .pipe(gulp.dest(wordpressPath));
})

// sass
gulp.task('sass', function() {
  return gulp.src('./dev/assets/stylesheets/**/*.scss')
    .pipe(sass({
        outputStyle: 'expanded',
        errLogToConsole:true,
        includePaths: [
          './',
          './dev/assets/stylesheets',
          './node_modules/normalize-scss/sass',          
        ]
    }))
    .on('error', function(errorInfo){
      console.log(errorInfo.toString());
      this.emit('end');
    })            
    .pipe(gulp.dest(wordpressPath + '\\assets\\stylesheets\\'));
});


// pug
gulp.task('pug', function() {
  return gulp.src('./dev/*.pug')
  .pipe(pug({
    pretty: true,
    doctype: 'php'
  }))
  .on('error', function(errorInfo){
    console.log(errorInfo.toString());
    this.emit('end');
  }) 
  .pipe($.if(/\.html$/, $.rename((file) => {
    file.basename = file.basename.replace('.html', '');
    file.extname = '.php';
  
    return file;
  })))

  .pipe(gulp.dest(wordpressPath))
});


// pug refresh after 'pug' task's finished
gulp.task('pugRefresh', ['pug'], function() {
  browserSync.reload();
});


// browserSync
gulp.task('browser-sync', function(){
  browserSync.init(['build/assets/stylesheets/*.css', 'dev/assets/scripts/**/*.js', 'build/assets/scripts/*.js'],
    {
      server: {
        baseDir: "./build/"
      }
    });
});


// webpack for scripts
gulp.task('scripts', function(callback) {
  webpack( require('./webpack.config.js'), function(err, stats) {
    if (err) {
      console.log( err.toString() );
    }
     console.log( stats.toString() );
    callback();
  });
});

// scripts refresh after 'scripts' task's finished
gulp.task('scriptsRefresh', ['scripts'], function(){
  browserSync.reload();
});

// watch
gulp.task('watch', ['clean','copyOtherStuff', 'pug', 'scripts', 'sass'], function(){
  gulp.watch(['./dev/assets/stylesheets/**/*.scss'], ['sass']);
  gulp.watch(['./dev/*.pug'], ['pugRefresh'] );
  gulp.watch(['./dev/assets/scripts/**/*.js'], ['scriptsRefresh']);
  gulp.watch(['./dev/**/*.php', './dev/**/img/*'], ['copyOtherStuff']); 
})