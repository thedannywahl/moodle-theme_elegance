
module.exports = function(grunt) {

    // Import modules.
    var path = require('path');

    // Theme Bootstrap constants.
    var LESSDIR         = 'less',
        THEMEDIR        = path.basename(path.resolve('.'));

    // PHP strings for exec task.
    var moodleroot = path.dirname(path.dirname(__dirname)),
        configfile = '',
        decachephp = '',
        dirrootopt = grunt.option('dirroot') || process.env.MOODLE_DIR || '';

    // Allow user to explicitly define Moodle root dir.
    if ('' !== dirrootopt) {
        moodleroot = path.resolve(dirrootopt);
    }

    configfile = path.join(moodleroot, 'config.php');

    decachephp += 'define(\'CLI_SCRIPT\', true);';
    decachephp += 'require(\'' + configfile  + '\');';
    decachephp += 'theme_reset_all_caches();';

    grunt.initConfig({
        less: {
            // Compile moodle styles.
            moodle: {
                options: {
                    compress: false,
                    sourceMap: true,
                    sourceMapRootpath: '/theme/' + THEMEDIR,
                    sourceMapFilename: 'style/elegance.css'
                },
                src: 'less/elegance.less',
                dest: 'style/elegance.css'
            }
        },
        exec: {
            decache: {
                cmd: 'php -r "' + decachephp + '"',
                callback: function(error, stdout, stderror) {
                    // exec will output error messages
                    // just add one to confirm success.
                    if (!error) {
                        grunt.log.writeln("Moodle theme cache reset.");
                    }
                }
            }
        },
        watch: {
            // Watch for any changes to less files and compile.
            files: ["less/**/*.less"],
            tasks: ["compile"],
            options: {
                spawn: false,
                livereload: true
            }
        },
        replace: {
            font_fix: {
                src: 'style/elegance.css',
                    overwrite: true,
                    replacements: [{
                        from: 'glyphicons-halflings-regular.eot',
                        to: 'glyphicons-halflings-regular.eot]]',
                    }, {
                        from: 'glyphicons-halflings-regular.svg',
                        to: 'glyphicons-halflings-regular.svg]]',
                    }, {
                        from: 'glyphicons-halflings-regular.ttf',
                        to: 'glyphicons-halflings-regular.ttf]]',
                    }, {
                        from: 'glyphicons-halflings-regular.woff',
                        to: 'glyphicons-halflings-regular.woff]]',
                    }]
            },
            sourcemap: {
                src: ['style/elegance.css'],
                    overwrite: true,
                    replacements: [{
                        from: 'sourceMappingURL=',
                        to: 'sourceMappingURL=/theme/'+ THEMEDIR + '/style/'
                    }]
            }
        }
    });

    // Load contrib tasks.
    grunt.loadNpmTasks("grunt-contrib-less");
    grunt.loadNpmTasks("grunt-contrib-watch");
    grunt.loadNpmTasks("grunt-exec");
    grunt.loadNpmTasks("grunt-text-replace");

    // Register tasks.
    grunt.registerTask("default", ["watch"]);
    grunt.registerTask("decache", ["exec:decache"]);

    grunt.registerTask("compile", ["less", "replace:font_fix", "replace:sourcemap", "decache"]);
};
