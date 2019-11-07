const gulp = require('gulp');
const plumber = require('gulp-plumber');
const autoprefixer = require('autoprefixer');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const uglify = require('gulp-uglify');
const sourcemaps = require('gulp-sourcemaps');
const clean = require('postcss-discard-comments');
const cleanCSS = require('gulp-clean-css');
const url = require('postcss-url');

gulp.task('build:css', function() {
    return gulp.src('assets/css/*.css')
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(concat('main.css'))
        .pipe(postcss([
            autoprefixer(),
            url({
                url: 'inline',
                maxSize: 32,
            }),
            clean()
        ]))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('../css/'));
});

gulp.task('build:js', function() {
    return gulp.src([
        'assets/js/vendor/zepto.js',
        'assets/js/vendor/zepto.cookie.js',
        'assets/js/*.js'
        ])
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('../js/'));
});

gulp.task('build', gulp.series(['build:css', 'build:js']));

gulp.task('watch:css', function() {
    gulp.watch('assets/css/*.cs', ['build:css']);
    gulp.watch('assets/js/*.js', ['build:js']);
})