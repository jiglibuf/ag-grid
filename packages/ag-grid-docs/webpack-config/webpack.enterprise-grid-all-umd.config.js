// for js examples that just require enterprise functionality (landing pages, vanilla enterprise examples etc)

const merge = require('webpack-merge');
const common = require('./webpack.common.config.js');
// const path = require('path');
const webpack = require('webpack');

/* mostly used by landing pages */
module.exports = merge(common, {
    mode: 'development',
    entry: {
        '@ag-enterprise/grid-all-modules': './src/_assets/ts/enterprise-grid-all-modules-umd.ts'
    },

    output: {
        filename: 'ag-grid-enterprise.js',
        library: ['agGrid'],
        libraryTarget: 'umd',
        publicPath: '/'
    },
    // resolve: {
    //     alias: {
    //         'ag-grid-community': path.resolve('./src/_assets/ts/ag-grid-community.ts'),
    //     },
    //     extensions: ['.ts', '.js']
    // },

    plugins: [new webpack.NamedModulesPlugin()]
});
