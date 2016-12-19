// jshint node:true

module.exports = function( grunt ) {
    'use strict';

    var loader = require( 'load-project-config' ),
        config = require( 'grunt-theme-fleet' );
    config = config();
    config.files.php.push( '!inc/admin/**/*.php' );
    config.files.php.push( '!class-tgm-plugin-activation.php' );
    config.files.js.push( '!inc/admin/**/*.js' );

    config.files.js.push( '!js/imagesloaded.pkgd.min.js' );
    config.files.js.push( '!js/imagesloaded.pkgd.js' );
    config.files.js.push( '!js/jquery.fitvids.js' );
    config.files.js.push( '!js/jquery.slicknav' );
    config.files.js.push( '!js/main.js' );
    config.files.js.push( '!js/masonry-init.js' );
    config.files.js.push( '!js/html5shiv.js' );
    config.files.js.push( '!js/parallax.js' );
    loader( grunt, config ).init();
};