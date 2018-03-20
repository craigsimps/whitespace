'use strict';

var gulp = require('gulp'),
    toolkit = require('gulp-wp-toolkit');

require('gulp-stats')(gulp);

toolkit.extendConfig({
    theme: {
        name: "Whitespace",
        homepage: "https://craigsimpson.scot",
        description: "Whitespace child theme, built on the Genesis Framework.",
        author: "Craig Simpson <craig@craigsimpson.scot>",
        version: "1.0.0",
        license: "GPL-3.0",
        textdomain: "whitespace",
        domainpath: "/languages",
        template: "genesis"
    },
    dest: {
        images: 'assets/images/',
        js: 'assets/js/'
    },
    js: {
        'whitespace': [
            'node_modules/jquery-backstretch/jquery.backstretch.js',
            'node_modules/list.js/dist/list.js',
            'develop/js/responsive-menu.js',
            'develop/js/global.js'
        ]
    }
});

toolkit.extendTasks(gulp, { /* gulp task overrides */ });
