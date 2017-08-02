var path = require('path');
var wordpressPath = 'C:\\xampp\\htdocs\\wordpress\\wp-content\\themes\\JujuStudioTheme';

module.exports = {
  entry: "./dev/assets/scripts/app.js",
  output: {
    path:  path.join(wordpressPath, '\\assets\\scripts'),
    filename: "app.js"
  },
  module: {
    rules: [
      {
        use: 'babel-loader',
        test: /\.js$/,
        exclude: /node_modules/
      }
    ]
  }
};
