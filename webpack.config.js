const ExtractTextPlugin = require("extract-text-webpack-plugin");
const staticPath        = __dirname + '/frontend/assets';
const distPath          = __dirname + '/frontend/web/dist';

module.exports = {
    entry:   [
        staticPath + '/webpack/index.ts',
    ],
    resolve: {
        extensions: [ '.tsx', '.ts', '.js' ],
    },
    output:  {
        filename: 'site.js',
        path:     distPath
    },
    module:  {
        rules: [
            {
                test:    /\.js$/,
                exclude: /node_modules/,
                use:     {
                    loader:  'babel-loader',
                    options: {
                        presets: ['env']
                    }
                }
            },
            {
                test: /\.(css|scss)$/,
                use:  ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use:      ['css-loader', 'sass-loader']
                })
            },
            {
                test:   /\.(woff|woff2|eot|ttf|otf)$/,
                loader: 'file-loader'
            },
            {
                test: /\.(tsx|ts)?$/,
                use: 'ts-loader',
                exclude: /node_modules/,
            },
        ],
    },
    plugins: [
        new ExtractTextPlugin('site.css')
    ]
};
