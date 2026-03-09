import traceback
import pikepdf
import os

pdf_dir = r"c:\wamp64\www\vivahub\vivahub_laravel\public\assets\store\logos_pdf"

def strip_text(pdf_path):
    try:
        pdf = pikepdf.Pdf.open(pdf_path)
        for i, page in enumerate(pdf.pages):
            commands = pikepdf.parse_content_stream(page)
            # Remove Tj, TJ, ', "
            text_ops = [b'Tj', b'TJ', b"'", b'"']
            new_commands = [cmd for cmd in commands if cmd[1] not in text_ops]
            new_stream = pikepdf.unparse_content_stream(new_commands)
            page.Contents = pdf.make_stream(new_stream)
        
        clean_path = pdf_path + "_clean.pdf"
        pdf.save(clean_path)
        pdf.close() # Close to release file lock
        
        os.replace(clean_path, pdf_path)
        print(f"Cleaned {pdf_path}")
    except Exception as e:
        print(f"Error on {pdf_path}: {traceback.format_exc()}")

for i in range(1, 11):
    file_path = os.path.join(pdf_dir, f"Couple Logo ({i}).pdf")
    if os.path.exists(file_path):
        strip_text(file_path)
