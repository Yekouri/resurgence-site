const gulp = require('gulp');
const plumber = require('gulp-plumber');
const autoprefixer = require('autoprefixer');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const clean = require('postcss-discard-comments');
const cleanCSS = require('gulp-clean-css');
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

gulp.task('watch:css', function() {
    gulp.watch('assets/css/*.cs', ['build:css']);
})