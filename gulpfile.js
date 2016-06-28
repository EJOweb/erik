/* 
 * npm install --save-dev gulp gulp-plumber gulp-rename gulp-concat gulp-sass gulp-autoprefixer gulp-uglify gulp-jshint
 */

/* Gulp */
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var concat = require('gulp-concat');

/* CSS */
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

/* Javascript */
var uglify = require('gulp-uglify');
var jshint = require('gulp-jshint');

/* Settings */
var dir = {
    build: {
        sass:    './_build/scss/',
        scripts: './_build/js/',
    },
    dist: {
        sass:    './assets/css/',
        scripts: './assets/js/',
    },
};

var files = {
    sass: [ 
            dir.build.sass + '**/*.scss', 
            '!' + dir.build.sass + 'vendors/**/*.scss', // Exclude all vendors
            dir.build.sass + 'vendors/ejo/**/*.scss', // Include EJO vendor
          ],
    scripts: dir.build.scripts + '**/*.js',
};

var browser_support = 'last 2 version'; 

//* Create expanded and minified stylguesheet at the same time (performance is fast using libsass)
//* In case of error, show it only once
gulp.task('sass:main', function () {

    //* Create expanded stylesheet
    gulp.src([dir.build.sass + 'theme.scss'])
        .pipe(plumber())
        .pipe(sass({
            outputStyle: 'expanded'
        }))
        .pipe(autoprefixer({ remove: false, browsers:[browser_support] }))
        .pipe(gulp.dest(dir.dist.sass));

    //* Create minified stylesheet
    gulp.src([dir.build.sass + 'theme.scss'])
        .pipe(plumber())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(autoprefixer({ remove: false, browsers:[browser_support] }))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(dir.dist.sass));
});

// Scripts
gulp.task('scripts:main', function() {

    // Lint
    gulp.src(files.scripts)
        .pipe(plumber())
        .pipe(jshint())
        .pipe(jshint.reporter('default'));

    // Concatenate & Minify Scripts
    gulp.src(files.scripts)
        .pipe(plumber())
        .pipe(concat('theme.js'))
        .pipe(gulp.dest(dir.dist.scripts))
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(dir.dist.scripts));
});

// Rerun the task when a file changes
gulp.task('sass:main-watch', function() {
    gulp.watch(files.sass, ['sass:main']);
});

// Watch Files For Changes
gulp.task('scripts:watch', function() {
    gulp.watch( files.scripts, ['scripts:main'] );
});

/**
 * COMMAND LINE TASKS
 */

/* Only Sass main */
gulp.task('sass-main', ['sass:main', 'sass:main-watch']);

/* Sass (main and editor) */
gulp.task('sass', ['sass-main', 'sass-editor'] );

/* Only Scripts */
gulp.task('scripts', ['scripts:main', 'scripts:watch']);

/* Only Scripts and Sass main */
gulp.task('no-editor', ['scripts', 'sass-main']);

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['sass', 'scripts']);

