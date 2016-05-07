// Grab our gulp packages
var gulp         = require( 'gulp' ),
    gutil        = require( 'gulp-util' ),
    sass         = require( 'gulp-sass' ),
    autoprefixer = require( 'gulp-autoprefixer' ),
    jshint       = require( 'gulp-jshint' ),
    stylish      = require( 'jshint-stylish' ),
    concat       = require( 'gulp-concat' ),
    plumber      = require( 'gulp-plumber' ),
    bower        = require( 'gulp-bower' );

// Compile Sass & Autoprefix.
gulp.task( 'styles', function() {
	return gulp.src( './assets/scss/app.scss' )
		.pipe( plumber( function( error ) {
			gutil.log( gutil.colors.red( error.message ) );
			this.emit( 'end' );
		} ) )
		.pipe( sass() )
		.pipe( autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		} ) )
		.pipe( gulp.dest( './assets/css/' ) )
		.pipe( gulp.dest( './assets/css/' ) );
});

// JSHint & concat JavaScript
gulp.task( 'site-js', function() {
	return gulp.src([

		// Grab your custom scripts
		'./assets/js/scripts/*.js'
	] )
	.pipe( plumber() )
	.pipe( jshint() )
	.pipe( jshint.reporter( 'jshint-stylish' ) )
	.pipe( concat( 'scripts.js' ) )
	.pipe( gulp.dest( './assets/js' ) )
	.pipe( gulp.dest( './assets/js' ) );
});

// JSHint & concat Foundation JavaScript
gulp.task( 'foundation-js', function() {
	return gulp.src([
		'./vendor/foundation-sites/js/foundation.core.js',
		'./vendor/foundation-sites/js/foundation.util.*.js',
		'./vendor/foundation-sites/js/foundation.abide.js',
		'./vendor/foundation-sites/js/foundation.accordion.js',
		'./vendor/foundation-sites/js/foundation.accordionMenu.js',
		'./vendor/foundation-sites/js/foundation.drilldown.js',
		'./vendor/foundation-sites/js/foundation.dropdown.js',
		'./vendor/foundation-sites/js/foundation.dropdownMenu.js',
		'./vendor/foundation-sites/js/foundation.equalizer.js',
		'./vendor/foundation-sites/js/foundation.interchange.js',
		'./vendor/foundation-sites/js/foundation.magellan.js',
		'./vendor/foundation-sites/js/foundation.offcanvas.js',
		'./vendor/foundation-sites/js/foundation.orbit.js',
		'./vendor/foundation-sites/js/foundation.responsiveMenu.js',
		'./vendor/foundation-sites/js/foundation.responsiveToggle.js',
		'./vendor/foundation-sites/js/foundation.reveal.js',
		'./vendor/foundation-sites/js/foundation.slider.js',
		'./vendor/foundation-sites/js/foundation.sticky.js',
		'./vendor/foundation-sites/js/foundation.tabs.js',
		'./vendor/foundation-sites/js/foundation.toggler.js',
		'./vendor/foundation-sites/js/foundation.tooltip.js'
	])
	.pipe( concat( 'foundation.js' ) )
	.pipe( gulp.dest( './assets/js' ) )
	.pipe( gulp.dest( './assets/js' ) );
});

// Update Foundation with Bower and save to /vendor
gulp.task( 'bower', function() {
	return bower({ cmd: 'update' })
	.pipe( gulp.dest( 'vendor/' ) );
});

// Watch files for changes (without Browser-Sync)
gulp.task( 'watch', function() {

	// Watch .scss files
	gulp.watch( './assets/scss/**/*.scss', ['styles'] );

	// Watch site-js files
	gulp.watch( './assets/js/scripts/*.js', ['site-js'] );

	// Watch foundation-js files
	gulp.watch( './vendor/foundation-sites/js/*.js', ['foundation-js'] );

});

// Run styles, site-js and foundation-js
gulp.task( 'default', function() {
  gulp.start( 'styles', 'foundation-js' );
});
