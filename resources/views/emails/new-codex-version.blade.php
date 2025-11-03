<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New {{ $tool->name }} Release</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4a5568;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f7fafc;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .version-info {
            background-color: white;
            padding: 15px;
            border-left: 4px solid #4299e1;
            margin: 15px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4299e1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #718096;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New {{ $tool->name }} Release Available</h1>
    </div>

    <div class="content">
        <p>Hello Administrator,</p>

        <p>A new version of <strong>{{ $tool->name }}</strong> has been released on GitHub.</p>

        <div class="version-info">
            <h2 style="margin-top: 0;">Version {{ $versionData['version'] }}</h2>
            <p><strong>Released:</strong> {{ \Carbon\Carbon::parse($versionData['release_date'])->format('F j, Y') }}</p>
            @if(!empty($versionData['description']))
                <p><strong>Description:</strong> {{ $versionData['description'] }}</p>
            @endif
        </div>

        @if(!empty($versionData['changelog_url']))
            <a href="{{ $versionData['changelog_url'] }}" class="button">View Release Notes</a>
        @endif

        @if(!empty($versionData['download_url']))
            <a href="{{ $versionData['download_url'] }}" class="button" style="background-color: #48bb78;">Download Release</a>
        @endif

        <div class="footer">
            <p>This is an automated notification sent by the {{ config('app.name') }} application.</p>
        </div>
    </div>
</body>
</html>
