const gulp = require('gulp');
const less = require('gulp-less');
const concat = require('gulp-concat');
const minifyCSS = require('gulp-minify-css');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const LessAutoprefix = require('less-plugin-autoprefix');
const autoprefix = new LessAutoprefix({ browsers: ['last 2 versions'] });
const browserSync = require('browser-sync').create();

gulp.task('less', () => {
    gulp.src('./src/less/**/*.less')
        // .pipe(sourcemaps.init())
        .pipe(less({
            plugins: [autoprefix]
        }))
        .pipe(sourcemaps.write())
        // .pipe(concat('DEXTemplate.css'))
        // .pipe(minifyCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./dist/css'))
        .pipe(browserSync.stream());
});

gulp.task('serve', ['less'], () => {
    browserSync.init({
        server: './'
    });

    gulp.watch('./src/less/**/*.less', ['less']);
    gulp.watch('./src/*.html').on('change', browserSync.reload);
});

gulp.task('default', ['serve']);