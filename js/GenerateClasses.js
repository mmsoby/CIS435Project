import pdfjsLib from 'pdfjs-dist';
function pdfToText(url, separator = ' ') {
   let pdf = pdfjsLib.getDocument(url);
   return pdf.promise.then(function(pdf) { // get all pages text
      let maxPages = pdf._pdfInfo.numPages;
      let countPromises = []; // collecting all page promises
      for (let i = 1; i <= maxPages; i++) {
         let page = pdf.getPage(i);
         countPromises.push(page.then(function(page) { // add page promise
            let textContent = page.getTextContent();
            return textContent.then(function(text) { // return content promise
               return text.items.map(function(obj) {
                  return obj.str;
               }).join(separator); // value page text
            });
         }));
      };
      // wait for all pages and join text
      return Promise.all(countPromises).then(function(texts) {
         for(let i = 0; i < texts.length; i++){
            texts[i] = texts[i].replace(/\s+/g, ' ').trim();
         };
         return texts;
      });
   });
};

function GenerateClass (pdfURL) {
   pdfToText(pdfURL).then(function(pdfTexts) {
      console.log(pdfTexts);
      // RESULT: ['TEXT-OF-PAGE-1', 'TEXT-OF-PAGE-2', ...]
   }, function(reason) {
      console.error(reason);
   });

   console.log("url is " + pdfURL);
}