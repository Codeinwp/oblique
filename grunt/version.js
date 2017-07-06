/**
 * Version File for Grunt
 *
 * @package capri-pro
 */
/* jshint node:true */
// https://github.com/kswedberg/grunt-version
module.exports = {
    package: {
        options: {
            prefix: '"version"\\:\\s+"'
        },
        src: 'package.json'
    },
    project: {
        src: [
            'package.json'
        ]
    },
    style: {
        options: {
            prefix: 'Version\\:\.*\\s'
        },
        src: [
            'style.css',
        ]
    },
    php: {
        options: {
            prefix: '@version\\s+'
        },
        src: [
            '*.php',
            '**/*.php',
            '!.git/**',
            '!vendor/**',
            '!node_modules/**',
            '!logs/**'
        ]
    },
    js: {
        options: {
            prefix: '@version\\s+'
        },
        src: [
            '*.js',
            '**/*.js',
            '!*.min.js',
            '!**/*.min.js',
            '!.git/**',
            '!vendor/**',
            '!js/vendor/*.js',
            '!node_modules/**',
            '!logs/**'
        ]
    },
    css: {
        options: {
            prefix: '@version\\s+'
        },
        src: [
            '*.css',
            '**/*.css',
            '**/*.css',
            '!*.min.css',
            '!**/*.min.css',
            '!css/vendor/*.css',
            '!vendor/**',
            '!node_modules/**',
            '!logs/**'
        ]
    },


};