const { src, dest } = require('gulp');
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const sourcemaps = require('gulp-sourcemaps');

const jsPath = './js/*.js';

// Minifies all JS files in and creates min.js
function jsTask() {
  return src(jsPath)
    .pipe(sourcemaps.init())
    .pipe(concat('min.js'))
    .pipe(terser())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./js'));
}
exports.jsTask = jsTask;
