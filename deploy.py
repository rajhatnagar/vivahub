import ftplib
import os
import sys

HOSTNAME = "103.191.208.202"
USERNAME = "whlmstql"
PASSWORD = "" # To be filled in manually or via explicit variable from memory
REMOTE_PATH = "/public_html/beta"

FILES_TO_UPLOAD = [
    "app/Http/Controllers/PartnerController.php",
    "app/Http/Controllers/PaymentController.php",
    "resources/views/admin/templates/builder.blade.php",
    "resources/views/partner/dashboard.blade.php",
    "resources/views/partner/invite_1.blade.php",
    "resources/views/user/builder.blade.php",
    "resources/views/user/dashboard.blade.php",
    "resources/views/user/settings.blade.php"
]

def ensure_remote_dir(ftp, remote_dir):
    try:
        ftp.cwd(remote_dir)
        return
    except ftplib.error_perm:
        parts = remote_dir.split('/')
        if len(parts) > 1:
            parent = '/'.join(parts[:-1])
            ensure_remote_dir(ftp, parent)
        try:
            ftp.mkd(remote_dir)
            ftp.cwd(remote_dir)
        except ftplib.error_perm as e:
            print(f"Error creating {remote_dir}: {e}")

try:
    ftp = ftplib.FTP(HOSTNAME)
    ftp.login(USERNAME, PASSWORD)
    print(f"Connected to {HOSTNAME}")

    for file_path in FILES_TO_UPLOAD:
        if not os.path.exists(file_path):
            print(f"WARNING: File {file_path} not found locally, skipping.")
            continue

        remote_full_path = f"{REMOTE_PATH}/{file_path}"
        remote_dir = os.path.dirname(remote_full_path)
        
        # Reset to root and ensure directory exists
        ftp.cwd("/")
        ensure_remote_dir(ftp, remote_dir)
        
        with open(file_path, 'rb') as local_file:
            print(f"Uploading {file_path} -> {remote_full_path}")
            ftp.storbinary(f"STOR {os.path.basename(file_path)}", local_file)

    ftp.quit()
    print("Deployment completed.")

except Exception as e:
    print(f"Deployment failed: {e}")
