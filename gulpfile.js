//* Package variables
var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var rename = require('gulp-rename');

//* Config
var lib_dir = './lib/';

//* Make style.css from sass files
gulp.task('sass-expanded', function () {
    gulp.src(['./_includes/scss/style.scss'])
        .pipe(sass({
            outputStyle: 'expanded'
        }))
        .on('error', gutil.log)
        .pipe(gulp.dest('.'));
});

gulp.task('sass-minified', function () {
    gulp.src(['./_includes/scss/style.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .on('error', gutil.log)
        .pipe(sourcemaps.write('./'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('.'));
});

//* Default task
gulp.task('default', function () {
    gulp.watch( './_includes/scss/**/*.scss', ['sass-expanded']);
});

//* Live task
gulp.task('live', function () {
    //* Handle Stylesheets
    gulp.start('sass-expanded', 'sass-minified');
    
    //* Handle Javascripts
});