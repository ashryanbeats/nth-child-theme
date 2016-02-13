var gulp = require('gulp');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var runSeq = require('run-sequence');

gulp.task('default', function() {
	gulp.watch(['sass/main.scss', 'sass/**/*.scss'], function() {
        runSeq('buildCSS');
    });
});

gulp.task('buildCSS', function() {
    return gulp.src('./sass/main.scss')
        //.pipe(plumber())
        .pipe(sass())
        .pipe(rename('style.css'))
        .pipe(gulp.dest('./'));
});
