<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Community Tax Certificate (Cedula)</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #000; margin-bottom: 10px; }
        .form-group { margin-bottom: 8px; }
        .label { font-weight: bold; display: inline-block; width: 200px; }
        .value { display: inline-block; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Community Tax Certificate (Cedula)</h1>
        <p>Official Application Form</p>
    </div>

    <div class="section">
        <h2 class="section-title">1. Personal Information</h2>
        <div class="form-group">
            <span class="label">Name:</span>
            <span class="value">{{ $data['last_name'] }}, {{ $data['first_name'] }} {{ $data['middle_name'] ?? '' }} {{ $data['suffix'] ?? '' }}</span>
        </div>
        <div class="form-group">
            <span class="label">Barangay:</span>
            <span class="value">{{ $data['barangay'] }}</span>
        </div>
        <div class="form-group">
            <span class="label">Residential Address:</span>
            <span class="value">{{ $data['residential_address'] }}</span>
        </div>
        <div class="form-group">
            <span class="label">Date of Birth:</span>
            <span class="value">{{ date('F j, Y', strtotime($data['date_of_birth'])) }}</span>
        </div>
        <div class="form-group">
            <span class="label">Place of Birth:</span>
            <span class="value">{{ $data['place_of_birth'] }}</span>
        </div>
        <div class="form-group">
            <span class="label">Citizenship:</span>
            <span class="value">{{ $data['citizenship'] }}</span>
        </div>
        <div class="form-group">
            <span class="label">Civil Status:</span>
            <span class="value">{{ ucfirst($data['civil_status']) }}</span>
        </div>
        <div class="form-group">
            <span class="label">Profession/Occupation:</span>
            <span class="value">{{ $data['profession'] }}</span>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">2. Income and Tax Details</h2>
        <div class="form-group">
            <span class="label">Gross Annual Income:</span>
            <span class="value">PHP {{ number_format($data['gross_annual_income'], 2) }}</span>
        </div>
        <div class="form-group">
            <span class="label">Community Tax Due:</span>
            <span class="value">PHP {{ number_format($data['community_tax_due'], 2) }}</span>
        </div>
    </div>

   <div class="section" style="text-align: center; margin-top: 60px;">
        <div>This document serves as your receipt for your cedula application.</div>
    </div>
</body>
</html>