module.exports = function(grunt) {    
   grunt.initConfig({
   makepot: {
        target: {
            options: {
                domainPath: '/languages',
                potFilename: 'seo-assistant.pot',
                processPot: function( pot, options ) {

                    var translation,
                        excluded_meta = [
                            'Plugin Name of the plugin/theme',
                            'Plugin URI of the plugin/theme',
                            'Author of the plugin/theme',
                            'Author URI of the plugin/theme'
                        ];

                    for ( translation in pot.translations[''] ) {
                        if ( 'undefined' !== typeof pot.translations[''][ translation ].comments.extracted ) {
                            if ( excluded_meta.indexOf( pot.translations[''][ translation ].comments.extracted ) >= 0 ) {
                                console.log( 'Excluded meta: ' + pot.translations[''][ translation ].comments.extracted );
                                delete pot.translations[''][ translation ];
                            }
                        }
                    }

                    // return pot;

                    pot.headers['report-msgid-bugs-to'] = 'https://github.com/catchsquare/seo-assistant/issues';
                    pot.headers['language-team'] = 'cs army <cs.army021@gmail.com>';
                    pot.headers['last-translator'] = 'cs army <cs.army021@gmail.com>';
                    return pot;
                },
                type: 'wp-plugin'
            }
        }
    }
});
    grunt.loadNpmTasks( 'grunt-wp-i18n' );
    grunt.registerTask('default', ['makepot']);
    
}
