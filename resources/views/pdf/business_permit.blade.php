<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Business Permit</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 24px; }
        .title { font-size: 20px; font-weight: bold; }
        .subtitle { font-size: 14px; margin-bottom: 30px; }
        .section { 
            margin-bottom: 30px; 
            padding-bottom: 15px;
            border-bottom: 1px solid #f3f4f6;
        }
        .section-title { 
            font-weight: bold; 
            margin-bottom: 12px; 
            font-size: 18px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e5e7eb;
        }
        .field { margin-bottom: 10px; }
        .field-label { font-weight: bold; display: inline-block; width: 180px; font-size: 14px; }
        .footer { margin-top: 40px; text-align: center; font-size: 12px; }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">BUSINESS PERMIT</div>
            <div class="subtitle">City of Cebu - Office of the Barangay</div>
        </div>

        <div class="section">
            <div class="section-title">Business Information</div>
            <div class="field">
                <span class="field-label">Business Name:</span>
                <span>{{ $permit->business_name }}</span>
            </div>
            <div class="field">
                <span class="field-label">Type of Business:</span>
                <span>{{ ucfirst(str_replace('_', ' ', $permit->business_type)) }}</span>
            </div>
            <div class="field">
                <span class="field-label">Business Barangay:</span>
                <span>{{ $permit->business_barangay }}</span>
            </div>
            <div class="field">
                <span class="field-label">Business Address:</span>
                <span>{{ $permit->business_address }}</span>
            </div>
            <div class="field">
                <span class="field-label">Business Phone:</span>
                <span>{{ $permit->business_phone ?? 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Business Email:</span>
                <span>{{ $permit->business_email }}</span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Owner/Applicant Information</div>
            <div class="field">
                <span class="field-label">First Name:</span>
                <span>{{ $permit->owner_first_name }}</span>
            </div>
            <div class="field">
                <span class="field-label">Last Name:</span>
                <span>{{ $permit->owner_last_name }}</span>
            </div>
            <div class="field">
                <span class="field-label">Residential Address:</span>
                <span>{{ $permit->owner_address }}</span>
            </div>
            <div class="field">
                <span class="field-label">Phone Number:</span>
                <span>{{ $permit->owner_phone }}</span>
            </div>
            <div class="field">
                <span class="field-label">Email Address:</span>
                <span>{{ $permit->owner_email }}</span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Business Activity</div>
            <div class="field">
                <span class="field-label">Business Activity:</span>
                <span>{{ $permit->business_activity }}</span>
            </div>
            <div class="field">
                <span class="field-label">Capitalization:</span>
                <span>PHP {{ number_format($permit->capitalization, 2) }}</span>
            </div>
        </div>

        <div class="footer">
            <div>This document is computer generated and does not require a signature.</div>
            <div>Issued on: {{ date('F j, Y') }}</div>
        </div>
    </div>
</body>
</html>