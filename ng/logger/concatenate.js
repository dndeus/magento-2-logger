const fs = require('fs-extra');
const concat = require('concat');

concatenate = async () =>{
  const files = [
    './dist/logger/runtime-es2015.js',
    './dist/logger/polyfills-es2015.js',
    './dist/logger/main-es2015.js',
  ];

  await fs.ensureDir('../../view/adminhtml/web/js/output');
  await concat(files, '../../view/adminhtml/web/js/output/ng-element.js');
  await fs.copyFile('./dist/logger/styles.css', '../../view/adminhtml/web/css/ng-styles.css')
}
concatenate();
