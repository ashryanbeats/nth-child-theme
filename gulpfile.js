var gulp = require('gulp');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var livereload = require('gulp-livereload');
var runSeq = require('run-sequence');

gulp.task('default', function() {
	livereload.listen();
	gulp.start('build');

	gulp.watch(['sass/main.scss', 'sass/**/*.scss'], function() {
        runSeq('buildCSS', 'reload');
    });

    gulp.watch(['index.html'], function() {
    	runSeq('reload');
    })
});

gulp.task('build', function() {
    runSeq(['buildCSS']);
});

gulp.task('buildCSS', function() {
    return gulp.src('./sass/main.scss')
        //.pipe(plumber())
        .pipe(sass())
        .pipe(rename('style.css'))
        .pipe(gulp.dest('./'));
});

gulp.task('reload', function() {
    livereload.reload();
})
