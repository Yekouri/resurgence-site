const gulp = require('gulp');
const plumber = require('gulp-plumber');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const uglify = require('gulp-uglify-es').default;
const sourcemaps = require('gulp-sourcemaps');
const clean = require('postcss-discard-comments');
const cleanCSS = require('gulp-clean-css');
const url = require('postcss-url');
const cssnext = require('postcss-cssnext');
const sass = require('gulp-sass');
const imagemin = require('gulp-imagemin');
const print = require('gulp-print').default;

gulp.task('my-sass-task', function () {
    return gulp.src('./assets/scss/*.scss')   // note file ext
      .pipe(sass().on('error', sass.logError))
      .pipe(gulp.dest('../js/'));
  });
  

gulp.task('build:css', function() {
    return gulp.src('./assets/scss/*.scss')
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('main.css'))
        .on('error', function (error) {
			console.log(error.toString());
			this.emit('end');
		})
        .pipe(postcss([
            url({
                url: 'inline',
                maxSize: 32,
            }),
            clean(),
            cssnext({
                browsers: 'last 2 versions, iOS 8',
                features: {
                    calc: false,
                }
            })
        ]))
        .pipe(cleanCSS())
        .pipe(gulp.dest('../css/'))
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
        .pipe(sourcemaps.write('../js/'))
        .pipe(gulp.dest('../js/'));
});

gulp.task('build:img', function() {
    return gulp.src([
        'assets/img/*.jpg',
        'assets/img/*.png',
        ])
        .pipe(imagemin())
        .pipe(gulp.dest('../img/'));
});

gulp.task('build', gulp.series(['build:css', 'build:js', 'build:img']));

gulp.task('watch', function () {
    gulp.watch(['./assets/scss/*.scss'], gulp.series(['build:css']));
    gulp.watch(['./assets/js/*.js'], gulp.series(['build:js']));
    gulp.watch(['./assets/img/*'], gulp.series(['build:img']));
});