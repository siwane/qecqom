let Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .setManifestKeyPrefix('build/')

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    // Custom files
    .addStyleEntry('css/app', './assets/css/global.scss')
    .addEntry('js/vue', './assets/js/vue.js')

    .enableSassLoader()
    .enableVueLoader()
;

module.exports = Encore.getWebpackConfig();