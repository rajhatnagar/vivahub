import fitz
doc = fitz.open(r'c:\wamp64\www\vivahub\vivahub_laravel\public\assets\store\logos_pdf\Couple Logo (1).pdf')
page = doc[0]
stream = page.read_contents()

# Replace Aarav with Rahul
stream = stream.replace(b'Aarav ', b'Rahul ')
page.set_contents(stream)
doc.save(r'c:\wamp64\www\vivahub\test_edit_python.pdf')
