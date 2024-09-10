var gulp = require('gulp'),
    sass = require('gulp-sass')(require('sass')),
    cleanCss = require('gulp-clean-css'),
    sourcemaps = require('gulp-sourcemaps'),
    clean = require('gulp-clean'),
    autoprefixer = require('gulp-autoprefixer'),
    rev = require('gulp-rev'),
    browserSync = require('browser-sync').create(),
    paths = {
      host: 'localhost:8040',
      dest: 'dist',
      mainScss: 'assets/sass/main.scss',
      scss: 'assets/sass/**/*.scss',
    }

gulp.task('style', function () {
  return (
    gulp
      .src(paths.mainScss)
      .pipe(sourcemaps.init())
      .pipe(sass())
      .pipe(autoprefixer("last 2 versions", "> 1%", "Explorer 7", "Android 2"))
      .pipe(cleanCss())
      .pipe(rev())
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest(paths.dest))
      .pipe(rev.manifest())
      .pipe(gulp.dest(paths.dest))
  )
});

gulp.task('clearDist', function (done) {
  return (
    gulp
      .src(['dist', 'build/dist', 'build/src'], {allowEmpty: true})
      .pipe(clean())
  )
});

gulp.task('reload', function (done) {
  browserSync.reload();
  done();
});

gulp.task('watch', function () {
  browserSync.init({
    proxy: paths.host
  });

  gulp.watch([paths.scss], gulp.series('clearDist', 'style', 'reload'));
});

gulp.task('default', gulp.series('clearDist', 'style'));
