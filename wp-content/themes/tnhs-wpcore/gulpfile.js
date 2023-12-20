const gulp = require('gulp')
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const cssnano = require('cssnano')
const tailwindcss = require('tailwindcss')
const sass = require('gulp-sass')(require('sass'))
const minify = require('gulp-minify')

const css = () => {
    const plugins = [
        autoprefixer({ overrideBrowserslist: ['last 1 version'] }),
        tailwindcss(),
        cssnano(),
    ];
    return gulp.src('./assets/sass/style.sass')
        .pipe(sass.sync({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(gulp.dest('./'))
}

const js = () => {
    return gulp.src('./assets/js/*.js')
        .pipe(minify({
            ext: {
                src: '-debug.js',
                min: '.min.js',
            },
            noSource: true,
            exclude: ['tasks'],
            ignoreFiles: ['*.min.js']
        }))
        .pipe(gulp.dest('./assets/js'))
}

exports.default = () => {
    gulp.watch([
        './assets/sass/**/*.sass',
        './assets/js/scripts.js',
        '*.php',
        './page-template/*.php',
        './template-parts/**/*.php',
        './woocommerce/**/*.php',
    ], { events: 'change' }, gulp.parallel(css, js))
}
