const fs = require("fs");
const { PDFDocument } = require("pdf-lib");

async function run() {
  const doc = await PDFDocument.load(
    fs.readFileSync(
      "c:/wamp64/www/vivahub/vivahub_laravel/public/assets/store/logos_pdf/Couple Logo (1).pdf",
    ),
  );
  const page = doc.getPages()[0];
  const contents = page.node.Contents();

  let streamRefs = [];
  if (contents.constructor.name === "PDFArray") {
    streamRefs = contents.elements;
  } else {
    streamRefs = [contents];
  }

  for (const ref of streamRefs) {
    const stream = doc.context.lookup(ref);
    if (stream) {
      const pdfLib = require("pdf-lib");
      const ops = pdfLib.decodePDFRawStream(stream).decode();
      const filteredOps = ops.filter(
        (op) => !["Tj", "TJ", "T*", '\"', "\\'"].includes(op.operator),
      );
      const newStream = doc.context.flateStream(filteredOps);
      doc.context.assign(ref, newStream);
    }
  }

  fs.writeFileSync("c:/wamp64/www/vivahub/test_stripped.pdf", await doc.save());
  console.log("Done");
}

run().catch(console.error);
