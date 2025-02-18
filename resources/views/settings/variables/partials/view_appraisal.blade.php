<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Appraisal - Base Practice Support</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #0d6efd;
            --light-bg: #f7f9fc;
            --border-color: #e9ecef;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: #2d3748;
            line-height: 1.6;
            padding: 20px;
        }
        
        .page-container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 30px;
        }
        
        .company-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            border-bottom: 2px solid var(--accent-color);
        }
        
        .company-name {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }
        
        .subtitle {
            font-size: 1.1rem;
            color: #666;
            margin-top: 10px;
        }
        
        .section-container {
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid var(--border-color);
            border-radius: 8px 8px 0 0;
        }
        
        .section-title-wrapper {
            display: flex;
            align-items: center;
        }
        
        .section-icon {
            color: var(--accent-color);
            font-size: 1.2rem;
            margin-right: 10px;
        }
        
        .section-title {
            margin: 0;
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .evaluator-badge {
            font-size: 0.9rem;
            color: #555;
            background-color: #f0f0f0;
            padding: 5px 12px;
            border-radius: 20px;
        }
        
        .section-content {
            padding: 20px;
        }
        
        .weightage-display {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            display: flex;
            align-items: center;
        }
        
        .weightage-label {
            font-weight: 500;
            color: #555;
            margin-right: 10px;
        }
        
        .weightage-value {
            font-weight: 600;
            color: var(--accent-color);
        }
        
        .indicators-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .indicators-title i {
            margin-right: 10px;
            color: var(--accent-color);
        }
        
        .indicator-item {
            padding: 12px 15px;
            background-color: #ffffff;
            border-left: 3px solid var(--accent-color);
            margin-bottom: 12px;
            border-radius: 0 4px 4px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .indicator-name {
            margin: 0;
            font-size: 1rem;
            color: #333;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .evaluator-badge {
                margin-top: 10px;
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Company Header -->
        <div class="company-header">
            <h1 class="company-name">Base Practice Support</h1>
            <p class="subtitle">Employee Performance Appraisal</p>
        </div>

        <!-- Sections Container -->
        <div id="sectionsContainer">
            @foreach($sections as $index => $section)
            <div class="section-container">
                <div class="section-header">
                    <div class="section-title-wrapper">
                        <i class="bi bi-folder section-icon"></i>
                        <h3 class="section-title">{{$section['name']}}</h3>
                    </div>
                    
                    @php
                        $evaluator = '';
                        switch($section['evaluate_by']) {
                            case '1':
                                $evaluator = 'Admin';
                                break;
                            case '4':
                                $evaluator = 'Manager/TeamLead';
                                break;
                            case '20':
                                $evaluator = 'Director';
                                break;
                            case '6':
                                $evaluator = 'HR';
                                break;
                            default:
                                $evaluator = $section['evaluate_by'];
                        }
                    @endphp
                    <div class="evaluator-badge">
                        <i class="bi bi-person-check"></i> Evaluated by: {{ $evaluator }}
                    </div>
                </div>
                
                <div class="section-content">
                    <!-- Weightage Display -->
                    <div class="weightage-display">
                        <i class="bi bi-bar-chart me-2" style="color: var(--accent-color);"></i>
                        <span class="weightage-label">Section Weightage:</span>
                        <span class="weightage-value">{{$section['weightage']}}</span>
                    </div>

                    <!-- Performance Indicators -->
                    <div class="indicators-section">
                        <h4 class="indicators-title">
                            <i class="bi bi-list-check"></i>
                            Performance Indicators
                        </h4>
                        
                        <div class="indicator-list">
                            @foreach($section["performance_indicator"] as $indicators) 
                            <div class="indicator-item">
                                <h5 class="indicator-name">{{$indicators["name"]}}</h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>