<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ __('Prescription') }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            direction: ltr;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            border-bottom: 2px solid #2563eb;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 15px;
        }
        .hospital-name {
            color: #2563eb;
            font-size: 24px;
            margin: 0;
        }
        .prescription-info {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .info-item {
            margin: 0;
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        .info-label {
            color: #64748b;
            font-weight: bold;
            margin-right: 8px;  /* changed from margin-left */
        }
        .prescription-content {
            background: white;
            padding: 25px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin: 20px 0;
        }
        .content-title {
            color: #2563eb;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .prescription-text {
            white-space: pre-line;
            line-height: 1.8;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px dashed #e2e8f0;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin-top: 50px;
            margin-left: auto;  /* changed from margin-right */
            text-align: center;
            padding-top: 5px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 60px;
            color: rgba(37, 99, 235, 0.1);
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="watermark">{{ 'HMS' }}</div>
    
    <div class="header">
        <h1 class="hospital-name">{{ 'HMS' }}</h1>
    </div>

    <div class="prescription-info">
        <div class="info-grid">
            <p class="info-item">
                <span class="info-label">{{ __('Doctor') }}:</span>
                Dr. {{ $prescription->doctor->name }}
                <br>
                <small>{{ $prescription->doctor->specialization->name ?? '' }}</small>
            </p>
            <p class="info-item">
                <span class="info-label">{{ __('Patient') }}:</span>
                {{ $prescription->patient->name }}
            </p>
            <p class="info-item">
                <span class="info-label">{{ __('Prescription Date') }}:</span>
                {{ $prescription->created_at->format('Y-m-d') }}
            </p>
            <p class="info-item">
                <span class="info-label">{{ __('Appointment Date') }}:</span>
                {{ \Carbon\Carbon::parse($prescription->appointment->date)->format('l, F j, Y') }}
            </p>
        </div>
    </div>

    <div class="prescription-content">
        <h3 class="content-title">{{ __('Medical Instructions') }}</h3>
        <div class="prescription-text">{{ $prescription->description }}</div>
    </div>

    <div class="footer">
        <div class="signature-line">
            {{ __('Doctor Signature') }}
        </div>
        <p style="text-align: left; margin-top: 20px; font-size: 12px; color: #64748b;">
            {{ __('Issued on') }}: {{ now()->format('Y-m-d h:i A') }}
        </p>
    </div>
</body>
</html>