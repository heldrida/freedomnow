/**
 * gulp
 * $ npm install gulp gulp-livereload gulp-watch gulp-sass gulp-rename gulp-plumber --save-dev
 */

// Load plugins
var gulp = require('gulp'),
    livereload = require('gulp-livereload'),
    watch = require('gulp-watch'),
    sass = require('gulp-sass'),
    plumber = require('gulp-plumber');

// Sass
gulp.task('sass', function () {
    return gulp.src('sass/*.scss')
           .pipe(plumber())
           .pipe(sass())
           .pipe(gulp.dest('./css'));
});

// Watch
gulp.task('watch', function () {

    // Watch `html`
    gulp.watch(['**/*.php', 'css/*.css', 'js/*.js']).on('change', livereload.changed);

    // Watch `scss` files
    gulp.watch('sass/*.scss', ['sass']);

    // Create liveReload server
    livereload.listen();

});