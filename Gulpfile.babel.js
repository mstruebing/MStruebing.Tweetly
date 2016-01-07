import gulp from 'gulp';
import sass from 'gulp-sass';
import babel from 'gulp-babel';
import minifycss from 'gulp-cssnano';
import minifyjs from 'gulp-minify';

let basePath = './Packages/Application/MStruebing.Tweetly';

let paths = {
    'private': basePath + '/Resources/Private/',
    'public': basePath + '/Resources/Public/'
};

gulp.task('MStruebing.Tweetly:compile:styles', () => {
  return gulp.src(paths.private + 'Styles/Main.scss')
    .pipe(sass())
    .pipe(minifycss())
    .pipe(gulp.dest(paths.public + 'Styles/'))
});

gulp.task('MStruebing.Tweetly:compile:scripts', () => {
  return gulp.src(paths.private + 'JavaScripts/App.js')
    .pipe(babel({
			presets: ['es2015']
		}))
    .pipe(minifyjs())
    .pipe(gulp.dest(paths.public + 'JavaScripts/'))
});
