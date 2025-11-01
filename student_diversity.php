<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Student Diversity - Live Chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

    <style>
        body {
            /* General body styles must be present if running this isolated */
            background-color: #0a0a0a; 
            color: #e6e6e6;
            font-family: 'Inter', sans-serif;
        }

        /* ------------------------------------------------------------------ */
        /* --- GLOBAL DIVERSITY SECTION STYLES --- */
        /* ------------------------------------------------------------------ */

        .global-diversity-section {
            background-color: #0a0a0a; 
            color: #e6e6e6;
            padding: 60px 0;
        }

        .global-diversity-box {
            background-color: #12121e; 
            border-radius: 15px;
            padding: 30px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 0 15px rgba(191, 0, 255, 0.2);
        }

        /* Map Placeholder Styling */
        .map-placeholder-box {
            background-color: #1c1c2b; 
            border-radius: 10px;
            padding: 80px 20px;
            min-height: 400px; 
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: inset 0 0 10px rgba(191, 0, 255, 0.3);
        }

        .map-title {
            font-size: 2rem;
            color: #BF00FF; 
            font-weight: 600;
        }

        /* Right Content Styling */
        .diversity-content-box {
            padding: 20px 0;
        }

        .diversity-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px #BF00FF;
        }

        .diversity-description {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #b0b0b0;
        }

        .pie-chart-container {
            width: 100%;
            max-width: 400px; /* Control max size of the chart */
            margin-top: 20px;
            margin-left: auto; 
            margin-right: auto;
            padding: 15px;
            background-color: #1c1c2b; /* Chart box background */
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            /* Important: Chart.js uses a <canvas> element */
        }

        /* Responsive Adjustments */
        @media (max-width: 991px) {
            .global-diversity-box {
                padding: 20px;
            }
            .map-placeholder-box {
                min-height: 300px;
                padding: 50px 20px;
            }
            .map-title {
                font-size: 1.8rem;
            }
            .diversity-content-box {
                text-align: center; 
            }
        }
    </style>
</head>
<body>

<section class="global-diversity-section py-5 my-5">
    <div class="container global-diversity-box">
        <div class="row align-items-center">
            
            <div class="col-lg-7 col-md-12 mb-4 mb-lg-0">
                <div class="map-placeholder-box">
                    <h2 class="map-title">Your Interactive Global Map Here</h2>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="diversity-content-box">
                    <h2 class="diversity-title">Our Global Diversity</h2>
                    
                    <p class="diversity-description">Oscord Code Academy boasts a diverse global student body, with individuals hailing from various countries across Asia, Europe, and America. This rich diversity fosters a vibrant and inclusive learning environment, where students can share unique perspectives and cultural experiences.</p>
                    
                    <div class="pie-chart-container">
                        <canvas id="studentDiversityChart"></canvas>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('studentDiversityChart').getContext('2d');
    
    // Student data based on your screenshot's legend
    const data = {
        labels: [
            'America', 'Finland', 'Japan', 'Korea', 'Kuwait', 
            'Myanmar', 'Qatar', 'Singapore', 'Sweden', 'Thailand', 'Vietnam'
        ],
        datasets: [{
            label: 'Students',
            // Placeholder data values (you can update these)
            data: [10, 5, 15, 12, 8, 30, 7, 20, 4, 18, 11], 
            backgroundColor: [
                '#4267B2',  // America (Blue)
                '#FF4500',  // Finland (Orange)
                '#FFC107',  // Japan (Yellow)
                '#28A745',  // Korea (Green)
                '#7C4DFF',  // Kuwait (Indigo/Purple)
                '#6A0DAD',  // Myanmar (Purple Dark)
                '#E91E63',  // Qatar (Pink/Red)
                '#4DB6AC',  // Singapore (Teal/Turquoise)
                '#607D8B',  // Sweden (Brown/Gray)
                '#FF6384',  // Thailand (Rose)
                '#63FF84'   // Vietnam (Light Green)
            ],
            hoverOffset: 4
        }]
    };

    // Configuration for the Pie Chart
    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#E6E6E6', // White/light gray legend text
                        font: {
                            family: 'Inter',
                            size: 10
                        },
                        boxWidth: 10,
                        padding: 10,
                    },
                },
                title: {
                    display: false
                }
            }
        },
    };

    // Initialize the chart
    new Chart(ctx, config);
});
</script>

</body>
</html>