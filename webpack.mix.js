const mix = require('laravel-mix');

const SRC_PATH = '/var/task/src';

mix
    .copy(SRC_PATH + '/resources/js/core.js', SRC_PATH + '/public/js/core.js')
    .copy(SRC_PATH + '/resources/js/book.js', SRC_PATH + '/public/js/book.js')
    .copy(SRC_PATH + '/resources/css/styles.css', SRC_PATH + '/public/css/styles.css');
