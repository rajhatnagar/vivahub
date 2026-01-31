<!DOCTYPE html>
<html>
<head>
    <title>Invitation</title>
</head>
<body style="font-family: sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; text-align: center; border: 1px solid #eee;">
        <h2 style="color: #C41E3A; font-family: serif;">Congratulations!</h2>
        <p>Dear {{ $groom }} & {{ $bride }},</p>
        <p><strong>{{ $agency }}</strong> has invited you to start planning your wedding on VivaHub.</p>
        <p>Click the button below to access your premium wedding dashboard and managing your invitation.</p>
        
        <br>
        <a href="{{ $link }}" style="display: inline-block; background-color: #C41E3A; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold;">Accept Invitation</a>
        <br><br>
        
        <p style="font-size: 12px; color: #888;">Planned & Managed by {{ $agency }}</p>
    </div>
</body>
</html>
