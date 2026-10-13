<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Project Brief</title>
    <style>
        body { font-family: 'Geist', system-ui, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .container { max-width: 640px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fff; border-radius: 16px; padding: 40px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .logo { font-family: 'Bricolage Grotesque', sans-serif; font-size: 24px; font-weight: 600; margin-bottom: 24px; }
        .field { margin-bottom: 20px; }
        .label { font-family: 'JetBrains Mono', monospace; font-size: 11px; text-transform: uppercase; color: #888; letter-spacing: 0.06em; margin-bottom: 4px; }
        .value { font-size: 16px; color: #222; line-height: 1.5; }
        .message { background: #f9f9f9; border-radius: 12px; padding: 20px; margin-top: 8px; white-space: pre-wrap; font-size: 15px; line-height: 1.6; }
        .footer { margin-top: 32px; padding-top: 20px; border-top: 1px solid #eee; font-size: 13px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="logo">Sky Web Innovations</div>
            <p style="margin: 0 0 32px; font-size: 18px; color: #444;">New project brief received</p>

            <div class="field">
                <div class="label">Name</div>
                <div class="value">{{ $inquiry->name }}</div>
            </div>

            <div class="field">
                <div class="label">Email</div>
                <div class="value">{{ $inquiry->email }}</div>
            </div>

            <div class="field">
                <div class="label">Project Type</div>
                <div class="value">{{ $inquiry->project_type }}</div>
            </div>

            <div class="field">
                <div class="label">Message</div>
                <div class="message">{{ $inquiry->message ?: '(No message provided)' }}</div>
            </div>

            <div class="footer">
                Received on {{ $inquiry->created_at->format('F j, Y \a\t g:i A') }}<br>
                <a href="{{ route('admin.contact-inquiries.index') }}">View in admin panel</a>
            </div>
        </div>
    </div>
</body>
</html>
