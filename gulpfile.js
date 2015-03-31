var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var rename = require('gulp-rename');

//* Make style.css from sass files
gulp.task('sass-expanded', function () {
    gulp.src(['./_inc/scss/style.scss'])
        .pipe(sass({
        	outputStyle: 'expanded'
        }))
        .pipe(gulp.dest('.'));
});

gulp.task('sass-minified', function () {
    gulp.src(['./_inc/scss/style.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass({
        	outputStyle: 'compressed'
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('.'));
});

//* Watch for changes and call 'sass'-function
gulp.task('watch', function () {
    gulp.watch( './_inc/scss/**/*.scss', ['sass']);
});

//* Watch for changes and call 'sass'-function
gulp.task('sass', function () {
    gulp.start('sass-expanded', 'sass-minified');
});

// Default task
gulp.task('default', function () {
    gulp.start('watch');
});