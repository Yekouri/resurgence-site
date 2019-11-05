const gulp = require('gulp');
const plumber = require('gulp-plumber');
const autoprefixer = require('autoprefixer');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const uglify = require('gulp-uglify');
const sourcemaps = require('gulp-sourcemaps');
const clean = require('postcss-discard-comments');
const cleanCSS = require('gulp-clean-css');
const babel = require('gulp-babel');
const url = require('postcss-url');

gulp.task('build:css', function() {
    return gulp.src('assets/css/*.css')
        .pipe(plumber())
        .pipe(sourcemaps.init())
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
        .pipe(gulp.dest('./public/css/'));
});

gulp.task('build:js', function() {
    return gulp.src([
        'assets/js/*.js'
        ])
        .pipe(babel({presets: ['@babel/env']}))
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js/'));
});

gulp.task('build', gulp.series(['build:css', 'build:js']));

gulp.task('watch:css', function() {
    gulp.watch('assets/css/*.cs', ['build:css']);
    gulp.watch('assets/js/*.js', ['build:js']);
})