/* EJOweb gulpfile
 * v20150708
 */

//* Package variables
var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var rename = require('gulp-rename');

//* Config
var lib_dir = './_includes/';

//* Create expanded and minified stylesheet at the same time (performance is fast using libsass)
//* In case of error, show it only once
gulp.task('sass', function () {

    //* Create expanded stylesheet
    gulp.src([lib_dir + 'scss/style.scss'])
        .pipe(sass({
            outputStyle: 'expanded'
        }))
        .on('error', gutil.log) // On error: show log and continue
        .pipe(gulp.dest('.'));

    //* Create minified stylesheet
    gulp.src([lib_dir + 'scss/style.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .on('error', gutil.noop) // On error: just continue because log is already shown above
        .pipe(sourcemaps.write('./'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('.'));
});

//* Default task
gulp.task('default', function () {
    gulp.watch( lib_dir + 'scss/**/*.scss', ['sass']);
});