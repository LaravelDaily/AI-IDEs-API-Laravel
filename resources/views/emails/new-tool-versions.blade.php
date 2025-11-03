<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Tool Releases Available</title>
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
        .tool-name {
            color: #4299e1;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4299e1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            margin-right: 10px;
            font-size: 14px;
        }
        .button.download {
            background-color: #48bb78;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #718096;
        }
        .release-count {
            background-color: #e6fffa;
            border-left: 4px solid #38b2ac;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Tool Releases Available</h1>
    </div>

    <div class="content">
        <p>Hello Administrator,</p>

        @if(count($releases) === 1)
            <p>A new version of <strong>{{ $releases[0]['tool']->name }}</strong> has been released.</p>
        @else
            <div class="release-count">
                <p style="margin: 0;"><strong>{{ count($releases) }} new releases</strong> have been detected across your monitored tools.</p>
            </div>
        @endif

        @foreach($releases as $item)
            <div class="version-info">
                <div class="tool-name">{{ $item['tool']->name }}</div>
                <h2 style="margin-top: 0;">Version {{ $item['release']['version'] }}</h2>
                <p><strong>Released:</strong> {{ \Carbon\Carbon::parse($item['release']['release_date'])->format('F j, Y') }}</p>
                @if(!empty($item['release']['description']))
                    <p><strong>Description:</strong> {{ $item['release']['description'] }}</p>
                @endif

                <div>
                    @if(!empty($item['release']['changelog_url']))
                        <a href="{{ $item['release']['changelog_url'] }}" class="button">View Release Notes</a>
                    @endif

                    @if(!empty($item['release']['download_url']))
                        <a href="{{ $item['release']['download_url'] }}" class="button download">Download Release</a>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="footer">
            <p>This is an automated notification sent by the {{ config('app.name') }} application.</p>
        </div>
    </div>
</body>
</html>
