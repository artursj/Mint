/**
 * Task usage:
 *
 * gulp       - run all tasks then watch the CSS/JS files for changes
 * gulp all   - process the CSS/JS files
 * gulp css   - process just the CSS files
 * gulp js    - process just the JS files
 */
var gulp = require('gulp'),
	autoprefixer = require('autoprefixer'),
	postcss = require('gulp-postcss'),
	pxtorem = require('postcss-pxtorem'),
	cleancss = require('gulp-clean-css'),
	uglify = require('gulp-uglify'),
	rename = require('gulp-rename'),
	notify = require('gulp-notify'),
	imagemin = require('gulp-imagemin');

var sources = {
	css: [
		'css/styles.css',
		'css/rtl.css',
		'css/spinkit.css'
	],
	js: [
		'js/jquery.fullscreen.js',
		'js/scripts.js'
	],
	adminCss: [
		'admin/css/styles.css',
		'admin/css/rtl.css'
	],
	adminJs: [
		'admin/js/admin.js',
		'admin/js/panel.js',
		'admin/js/metabox.js',
		'admin/js/color-schemes.js',
		'admin/js/palette-color-schemes.js'
	]
};

var destinations = {
	css: 'css/',
	js: 'js/',
	adminCss: 'admin/css/',
	adminJs: 'admin/js/'
};

var errors = {
	css: {
		theme: false,
		admin: false
	},
	js: {
		theme: false,
		admin: false
	}
};

var errorOptions = function (jsOrCss, adminOrTheme) {
	var options = {
		title:   'Gulp build error!',
		message: 'Error building the ' + adminOrTheme + ' ' + jsOrCss.toUpperCase() + ', did you make a mistake?',
		icon:    __dirname + '/images/gulp-notify-error.png'
	};

	return options;
};

var successOptions = function (jsOrCss, adminOrTheme) {
	var options = {
		title:   'Gulp build success!',
		message: 'The ' + adminOrTheme + ' ' + jsOrCss.toUpperCase() + ' is fine again.',
		icon:    __dirname + '/images/gulp-notify-success.png'
	};

	return options;
};

// CSS tasks
gulp.task('theme-css', function () {
	var errorThisTime = false;

	return gulp.src(sources.css)
		   .pipe(postcss([ autoprefixer('last 2 version'), pxtorem({ root_value: 13 }) ]))
		   .on('error', notify.onError(function () {
				errors.css.theme = errorThisTime = true;
				return errorOptions('css', 'theme');
			}))
		   .pipe(rename({suffix: '.min'}))
		   .pipe(cleancss({compatibility: 'ie8'}))
		   .pipe(gulp.dest(destinations.css))
		   .pipe(notify(function () {
				if (errorThisTime || ! errors.css.theme) {
					return false;
				}

				errors.css.theme = false;
				return successOptions('css', 'theme');
		   }));
});

gulp.task('admin-css', function () {
	var errorThisTime = false;

	return gulp.src(sources.adminCss)
		   .pipe(postcss([ autoprefixer('last 2 version') ]))
		   .on('error', notify.onError(function () {
				errors.css.admin = errorThisTime = true;
				return errorOptions('css', 'admin');
			}))
		   .pipe(rename({suffix: '.min'}))
		   .pipe(cleancss({compatibility: 'ie8'}))
		   .pipe(gulp.dest(destinations.adminCss))
		   .pipe(notify(function () {
				if (errorThisTime || ! errors.css.admin) {
					return false;
				}

				errors.css.admin = false;
				return successOptions('css', 'admin');
		   }));
});

// JS tasks
gulp.task('theme-js', function () {
	var errorThisTime = false;

	return gulp.src(sources.js)
		   .pipe(rename({suffix: '.min'}))
		   .pipe(uglify({ preserveComments: 'some' }))
		   .on('error', notify.onError(function (error) {
				errors.js.theme = errorThisTime = true;
				return errorOptions('js', 'theme');
			}))
		   .pipe(gulp.dest(destinations.js))
		   .pipe(notify(function () {
				if (errorThisTime || ! errors.js.theme) {
					return false;
				}

				errors.js.theme = false;
				return successOptions('js', 'theme');
		   }));
});

gulp.task('admin-js', function () {
	var errorThisTime = false;

	return gulp.src(sources.adminJs)
		   .pipe(rename({suffix: '.min'}))
		   .pipe(uglify({ preserveComments: 'some' }))
		   .on('error', notify.onError(function () {
				errors.js.admin = errorThisTime = true;
				return errorOptions('js', 'admin');
			}))
		   .pipe(gulp.dest(destinations.adminJs))
		   .pipe(notify(function () {
				if (errorThisTime || ! errors.js.admin) {
					return false;
				}

				errors.js.admin = false;
				return successOptions('js', 'admin');
		   }));
});

// Meta tasks
gulp.task('css', ['theme-css', 'admin-css']);

gulp.task('js', ['theme-js', 'admin-js']);

gulp.task('all', ['css', 'js']);

// Watcher
gulp.task('default', ['all'], function () {
	gulp.watch(sources.css, ['theme-css']);
	gulp.watch(sources.adminCss, ['admin-css']);
	gulp.watch(sources.js, ['theme-js']);
	gulp.watch(sources.adminJs, ['admin-js']);
});
