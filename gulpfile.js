const gulp = require('gulp');
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();

const webpackConfig = require('./webpack.config.js');

function webpackBuild() {
  return gulp.src('./src/index.js')
    .pipe(webpackStream(webpackConfig, webpack))
    .pipe(gulp.dest('./assets'))
    .pipe(browserSync.stream());
}

function styles() {
  return gulp.src('./src/scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./assets/css'))
    .pipe(browserSync.stream());
}

function watchFiles() {
  gulp.watch('./src/scss/**/*.scss', styles);
  gulp.watch('./src/**/*.js', webpackBuild);
}

function serve(done) {
  browserSync.init({
    proxy: "http://localhost/featurestore/",
    notify: false, 
    open: true, 
    port: 3009 
  });
  done();
}

const build = gulp.series(webpackBuild, styles);
const watch = gulp.parallel(watchFiles, serve); 

exports.build = build;
exports.watch = watch;
exports.default = gulp.series(build, watch);
