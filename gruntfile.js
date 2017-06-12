/*
    Simple Login 360 - Grunt Configuration
*/

module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        // Task configuration for grunt-contrib-sass.
        sass: {
            dist: {
                options: {
                    style: 'compressed',
                    sourcemap: 'none'
                },
                files: { 
                    // destination : source
                    'public/css/app.css': 'resources/assets/sass/app.scss'
                }
            }
        },

        // Task configuration for grunt-contrib-watch.
        watch: {
            grunt: {
                files: ['gruntfile.js']
            },

            sass: {
                files: ['resources/assets/sass/**/*.scss'],
                tasks: ['sass']
            },

            uglify: {
                files: ['resources/assets/js/**/*.js'],
                tasks: ['uglify']
            }
        }
    });

    // Load required modules.
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('build', ['sass']);
    grunt.registerTask('default', ['build', 'watch']);
};