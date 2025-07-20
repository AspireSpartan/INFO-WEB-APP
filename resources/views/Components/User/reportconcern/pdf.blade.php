<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reported Concern Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
        .section-title { font-weight: bold; margin-bottom: 10px; }
        .field { margin-bottom: 8px; }
        .field-label { font-weight: bold; display: inline-block; width: 180px; }
        .footer { margin-top: 40px; text-align: center; font-size: 12px; }
        .signature-line { width: 200px; border-top: 1px solid #000; margin: 30px auto 5px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">REPORTED CONCERN RECEIPT</div>
        <div class="subtitle">City of Cebu - Office of the Barangay</div>
    </div>

    <div class="section">
        <div class="section-title">Reporter Information</div>
        <div class="field">
            <span class="field-label">Name:</span>
            <span>{{ $concern->reporter_name }}</span>
        </div>
        <div class="field">
            <span class="field-label">Email:</span>
            <span>{{ $concern->reporter_email }}</span>
        </div>
        <div class="field">
            <span class="field-label">Phone:</span>
            <span>{{ $concern->reporter_phone ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Address:</span>
            <span>{{ $concern->reporter_address ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Concern Details</div>
        <div class="field">
            <span class="field-label">Date Reported:</span>
            <span>{{ $concern->created_at->format('m/d/Y') }}</span>
        </div>
        <div class="field">
            <span class="field-label">Incident Date:</span>
            <span>{{ \Carbon\Carbon::parse($concern->concern_date)->format('m/d/Y') }}</span>
        </div>
        <div class="field">
            <span class="field-label">Incident Time:</span>
            <span>{{ $concern->concern_time ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Location:</span>
            <span>{{ $concern->concern_barangay }}</span>
        </div>
        <div class="field">
            <span class="field-label">Location Details:</span>
            <span>{{ $concern->concern_barangay_details ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Description:</span>
            <span>{{ $concern->concern_description }}</span>
        </div>
    </div>

    <div class="footer">
        <div>This document serves as your receipt for the reported concern.</div>
        <div>Reference ID: {{ $concern->id }}</div>
    </div>
</body>
</html>