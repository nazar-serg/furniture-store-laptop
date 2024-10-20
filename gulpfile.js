const gulp = require('gulp');
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create(); // Подключаем BrowserSync

// Подключаем Webpack конфигурацию
const webpackConfig = require('./webpack.config.js');

// Задача для сборки Webpack
function webpackBuild(done) {
  gulp.src('./src/index.js')
    .pipe(webpackStream(webpackConfig, webpack))
    .pipe(gulp.dest('./assets'))
    .on('end', browserSync.reload); // Перезагрузка браузера после сборки
  done();
}

// Задача для компиляции SCSS
function styles(done) {
  gulp.src('./src/scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./assets/css'))
    .on('end', browserSync.reload); // Перезагрузка браузера после компиляции
  done();
}

// Наблюдение за файлами
function watchFiles() {
  gulp.watch('./src/scss/**/*.scss', styles);
  gulp.watch('./src/**/*.js', webpackBuild);
}

// Задача для запуска BrowserSync с прокси
function serve(done) {
  browserSync.init({
    proxy: "http://furniture-store/",
    notify: false, // Отключить уведомления
    open: true, // Автоматически открывать браузер
    port: 3008 // Порт для сервера BrowserSync
  });
  done();
}

// Основные задачи
const build = gulp.series(webpackBuild, styles);
const watch = gulp.parallel(watchFiles, serve); // Запускаем наблюдение и сервер

// Экспорт задач
exports.build = build;
exports.watch = watch;
exports.default = gulp.series(build, watch);
