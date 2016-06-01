module.exports = function(grunt) {

    grunt.initConfig({
        browserify: {

            js: {
                src: 'public/app.js',
                dest: 'public/assets/build/main.js'
            },
            options: {
                browserifyOptions: {
                    debug: true
                }
            }

        },
		composer : {
			options : {
				usePhp: true,
				phpArgs: {
					allow_url_fopen: 'on'
				},
				flags: ['optimize-autoloader', 'no-dev', 'prefer-dist'],
				composerLocation: '/usr/local/bin/composer'
			},
			build: {
			}
		},

        less: {
            app: {
                options: {
                    paths: ["public/assets/styles"],
                    plugins: [
                        new(require('less-plugin-autoprefix'))({
                            browsers: ["last 2 versions"]
                        })
                    ]
                },
                files: {
                    'public/assets/styles/style.css': 'public/assets/styles/*.less'
                }
            }
        },
        cachebreaker: {
            dev: {
                options: {
                    match: ['.jpg', '.png', '.css', '.js'],
                    replacement: function() {
                        return Math.ceil(Date.now() / 1000); //Micro Seconds removed
                    }
                },
                files: {
                    src: [
                        'public/assets/styles/style.css'                        
                    ]
                }
            }
        },
        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'public/assets/styles/',
                    src: ['*.css', '!*.min.css'],
                    dest: 'public/assets/styles/'               
                }]
            }
        },
        uglify: {
            /*options: {
                sourceMap: true,
                sourceMapIncludeSources: true,
                sourceMapIn: 'frontend/assets/build/main.js.map'
            },*/
            app: {
                files: [{
                    expand: true,
                    cwd: 'public/assets/build/',
                    src: '*.js',
                    dest: 'public/assets/build/'
                }]
            }
        },
        clean: ['public/assets/build/'],
        watch: {
            scripts: {
                files: ['public/assets/**/*.js'],
                tasks: ['build']
            },
            gruntfile: {
                files: 'Gruntfile.js',
                tasks: ['build'],
                options: {
                    livereload: false
                }
            },
            less: {
                files: ['public/assets/styles/*.less'],
                tasks: ['less']
            },
            css: {
                files: ['public/assets/build/*.css'],
                tasks: ['cachebreaker', 'cssmin']
            }

        },
        connect: {
            server: {
                options: {
                    port: 8000,
                    base: 'public/assets'
                }
            }
        },
        exec: {
          build_labels: 'node update.js'
        }

    });

    grunt.loadNpmTasks('grunt-browserify');
    grunt.loadNpmTasks('grunt-cache-breaker');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-connect');
    grunt.loadNpmTasks('grunt-exec');
	grunt.loadNpmTasks('grunt-composer');


    grunt.registerTask('build', ['clean', 'browserify', 'less', 'cachebreaker', 'cssmin']);
	grunt.registerTask('default', ['build','composer:build:install']);
};