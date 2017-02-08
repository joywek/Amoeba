var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css');
var uglify = require("gulp-uglify");
var less = require('gulp-less');
var rsync = require('gulp-rsync');

gulp.task('copy-files', function() {
	gulp.src(['LICENSE', 'README.md', 'screenshot.png', 'style.css'])
	.pipe(gulp.dest('dist'));

	gulp.src('fonts/**/*')
	.pipe(gulp.dest('dist/fonts'));

	gulp.src('img/**/*')
	.pipe(gulp.dest('dist/img'));

	gulp.src('languages/**/*')
	.pipe(gulp.dest('dist/languages'));
});

gulp.task('minify-html', function() {
	gulp.src('*.php')
	.pipe(gulp.dest('dist'));

	gulp.src('template-pages/*.php')
	.pipe(gulp.dest('dist/template-pages'));
	
	gulp.src('template-parts/*.php')
	.pipe(gulp.dest('dist/template-parts'));
	
	gulp.src('inc/*.php')
	.pipe(gulp.dest('dist/inc'));
});

gulp.task('minify-css', function () {
	gulp.src(['less/blog.less', 'less/about.less'])
	.pipe(less())
	.pipe(gulp.dest('css'))
	.pipe(cleanCSS({compatibility: 'ie8'}))
	.pipe(gulp.dest('dist/css'));
});

gulp.task('minify-js', function () {
    gulp.src(['js/*.js', '!js/jquery.*'])
    .pipe(uglify())
    .pipe(gulp.dest('dist/js'));

	gulp.src('js/jquery.*')
	.pipe(gulp.dest('dist/js'));
});

gulp.task('deploy', function() {
	return gulp.src('dist/**')
		.pipe(rsync({
			root: 'dist',
			hostname: 'root@joywek.com',
			destination: '/var/www/amoeba/wp-content/themes/amoeba',
			incremental: true,
			times: true,
			compress: true,
			recursive: true,
			clean: true,
			links: true,
			command: true
		}));
});

gulp.task('watch', function() {
	gulp.watch('less/**/*.less', function() {
		gulp.src(['less/blog.less', 'less/page.less', 'less/about.less'])
		.pipe(less())
		.pipe(gulp.dest('css'));
	});
});
gulp.task('default', ['copy-files', 'minify-html', 'minify-css', 'minify-js']);
