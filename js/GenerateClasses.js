import PDFJS from "pdfjs-dist";
import PDFJSWorker from "pdfjs-dist/build/pdf.worker.js"; // add this to fit 2.3.0

PDFJS.disableTextLayer = true;
PDFJS.disableWorker = true; // not availaible anymore since 2.3.0 (see imports)

const getPageText = async (pdf, pageNo) => {
   const page = await pdf.getPage(pageNo);
   const tokenizedText = await page.getTextContent();
   return tokenizedText.items.map(token => token.str).join("");
};

/* see example of a PDFSource below */
export const getPDFText = async (source)=> {
   Object.assign(window, {pdfjsWorker: PDFJSWorker}); // added to fit 2.3.0
   const pdf= await PDFJS.getDocument(source).promise;
   const maxPages = pdf.numPages;
   const pageTextPromises = [];
   for (let pageNo = 1; pageNo <= maxPages; pageNo += 1) {
      pageTextPromises.push(getPageText(pdf, pageNo));
   }
   const pageTexts = await Promise.all(pageTextPromises);
   return pageTexts.join(" ");
};

function GenerateClass (pdfURL) {
   getPageText(pdfURL,1).then((text) => {
        console.log(text);
   });
   console.log("url is " + pdfURL);
}