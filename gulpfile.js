'use strict';

var gulp = require('gulp'),
    pkg = require('./package.json'),
    toolkit = require('gulp-wp-toolkit');

toolkit.extendConfig({
    theme: {
        name: 'Materialize Genesis',
        homepage: pkg.homepage,
        description: pkg.description,
        author: pkg.author,
        version: pkg.version,
        license: pkg.license,
        textdomain: pkg.name
    },
    css: {
        basefontsize: 16, // Used by postcss-pxtorem.
		cssnano: {
			discardComments: {
				removeAll: true
			},
			zindex: false,
		},
        remreplace: false, // Used by postcss-pxtorem.
        remmediaquery: true, // Used by postcss-pxtorem.
		scss: {
			'app': {
				src: 'develop/scss/app.scss',
				dest: 'assets/css/',
				outputStyle: 'compressed',
			},
		},
    },
    js: {
        'app': [
            'develop/js/source/*.js'
        ],
        'materialize': [
            'node_modules/materialize-css/dist/js/materialize.js'
        ]
    },
    dest: {
        js: 'assets/js/',
        css: 'assets/css/'
    },
    server: {
        proxy: 'wordpress.test',
        online: true
    }
});

toolkit.extendTasks(gulp, /* Gulp task overrides. */);