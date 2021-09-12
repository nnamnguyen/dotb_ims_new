

const webpack = require('webpack');
const path = require('path');

const devMode = process.env.DEV;

module.exports = {
    mode: devMode ? 'development' : 'production',
    optimization: {
        minimize: !devMode,
    },
    devtool: 'source-map',
    entry: {
        lumia: [
            'entry.js',
        ],
    },
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /node_modules/,
            use: [{
                loader: 'babel-loader',
                options: {
                    presets: [
                        ['env', {
                            targets: {
                                browsers: [
                                    'last 1 chrome version',
                                    'last 1 firefox version',
                                    'last 1 safari version',
                                    'last 1 edge version',
                                    'ie 11',
                                ],
                            },
                        }],
                    ],
                },
            }],
        }],
    },
    output: {
        path: path.resolve(__dirname, 'minified'),
        filename: '[name].min.js',
        sourceMapFilename: '[name].min.js.map',

        // map the path correctly to avoid being inside of webpack://
        devtoolModuleFilenameTemplate: 'lumia:///[resourcePath]',
        devtoolFallbackModuleFilenameTemplate: 'lumia:///[resourcePath]?[hash]',
    },
    plugins: ([
        new webpack.DefinePlugin({
            ZEPTO: 'false',
        })]
    ),
    resolve: {
        modules: [
            path.join(__dirname, 'src'),
            path.join(__dirname, 'lib'),
            path.join(__dirname, 'node_modules'),
        ],
    },
};
