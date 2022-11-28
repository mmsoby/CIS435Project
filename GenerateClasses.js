import * as pdfjsLib from 'pdfjs-dist';

function GenerateClass (pdfURL) {
   pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
   const loadingTask = pdfjsLib.getDocument('https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/examples/learning/helloworld.pdf');
   loadingTask.promise.then(function(pdf) {
      console.log(pdf);
   });
   console.log("url is " + pdfURL);
}