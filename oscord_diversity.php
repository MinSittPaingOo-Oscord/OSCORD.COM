<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Student Diversity</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

    <style>
        #oscordDiversity {
            background: transparent;
            color: #e6e6e6;
            padding: 60px 0;
            font-family: 'Times New Roman', serif;
        }

        #oscordDiversityContainer {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        #oscordDiversityRow {
            display: flex;
            flex-wrap: wrap;
            margin: -15px;
        }

        #oscordDiversityMapCol,
        #oscordDiversityContentCol {
            flex: 1 1 300px;
            padding: 15px;
        }

        #oscordDiversityMapCol {
            flex-basis: 45%;
            max-width: 45%;
        }

        #oscordDiversityContentCol {
            flex-basis: 55%;
            max-width: 55%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #oscordDiversityMapBox {
            background: transparent;
            border-radius: 10px;
            padding: 20px;
            min-height: 360px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #oscordDiversityGlobeImg {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        #oscordDiversityContentBox {
            padding: 20px 0;
        }

        #oscordDiversityContentTitle {
            font-family: 'Calibri' !important;
            font-size: 3rem;
            font-weight: 1000;
            color: #fff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px #BF00FF;
        }

        #oscordDiversityDescription {
            font-size: 1.3rem;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #e6e6e6;
            width: 90%;
            /* margin: 0 auto; */
            font-family: 'Calibri' !important;
            margin-left : 0px;
        }

        #oscordDiversityChartBox {
            width: 100%;
            max-width: 90%;
            margin: 0px auto 0;
            padding: 15px;
            background: transparent;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .5);
            position: relative;
            height: 380px; 
            font-size : 1.6em !important;
            color: #e6e6e6;
        }

        #oscordDiversityChartBox canvas {
            height: 360px !important; 
          
        }

        @media (max-width: 991px) {
            #oscordDiversityMapCol,
            #oscordDiversityContentCol {
                flex-basis: 100%;
                max-width: 100%;
            }

            #oscordDiversityMapBox {
                min-height: 300px;
                padding: 40px 20px;
            }

            #oscordDiversityGlobeImg {
                width: 90%;
                height: 90%;
                margin-bottom:0px;
            }

            #oscordDiversityContentTitle {
                margin-top : -60px !important;
                margin-bottom : 30px !important;
                text-align : left;
                margin-left : 35px;
            }

            #oscordDiversityContentCol {
                text-align: center;
            }

            #oscordDiversityChartBox {
                max-width: 90%;
                height: 420px; 
            }

            #oscordDiversityChartBox canvas {
                height: 400px !important;
                font-size : 2em;

            }

            #oscordDiversityDescription {
                font-size: 1.5em;
                text-align: left;
                margin-bottom : 50px;
            }
        }


        @media (max-width: 576px) {
            #oscordDiversityContentTitle {
                margin-left : 20px;
            }
            #oscordDiversityDescription {
                margin-left : 20px;
                margin-bottom : 50px;
            }
        }
    </style>
</head>
<body>

<div id="oscordDiversity">
    <div id="oscordDiversityContainer">
        <div id="oscordDiversityRow">

            <div id="oscordDiversityMapCol">
                <div id="oscordDiversityMapBox">
                    <img id="oscordDiversityGlobeImg" src="./image/globe.png" alt="Global Map">
                </div>
            </div>

            <div id="oscordDiversityContentCol">
                <div id="oscordDiversityContentBox">
                    <h2 id="oscordDiversityContentTitle">Our Global Diversity</h2>

                    <p id="oscordDiversityDescription">
                    Oscord Code Academy fosters a dynamic and inclusive global learning community, uniting Burmese students from various countries. Our flexible class scheduling enables robust discussions, accommodating diverse time zones and preferences. The cutting-edge technologies and practical skills taught in our courses are directly applicable to university projects, research, internships, and professional careers, empowering students to achieve academic excellence and thrive in their professional endeavors.
                    </p>

                    <div id="oscordDiversityChartBox">
                        <canvas id="studentDiversityChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('studentDiversityChart').getContext('2d');

        const rawData = [10,5,15,12,8,30,7,20,4,18,11];
        const total = rawData.reduce((a, b) => a + b, 0);

        const data = {
            labels: ['America','Finland','Japan','Korea','Kuwait',
                     'Myanmar','Qatar','Singapore','Sweden','Thailand','Vietnam'],
            datasets: [{
                label: 'Students',
                data: rawData,
                backgroundColor: [
                    '#4267B2','#FF4500','#FFC107','#28A745','#7C4DFF',
                    '#6A0DAD','#E91E63','#4DB6AC','#607D8B','#FF6384','#63FF84'
                ],
                borderWidth: 1,
                borderColor: '#333',
                borderRadius: 4,
                barThickness: 12  
            }]
        };

        Chart.register(ChartDataLabels);

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10,
                        right: 50
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: '#e6e6e6',
                            font: { size: 15 },
                            stepSize: 5
                        },
                        grid: { color: 'rgba(255,255,255,0.1)' }
                    },
                    y: {
                        ticks: {
                            color: '#e6e6e6',
                            font: { size: 15 },
                            maxRotation: 0,
                            padding: 8  
                        },
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#E6E6E6',
                            font: { family: 'Inter', size: 9 },
                            boxWidth: 8,
                            padding: 8
                        }
                    },
                    tooltip: {
                        bodyFont: { size: 11 },
                        titleFont: { size: 11 },
                        padding: 8,
                        cornerRadius: 4,
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed.x;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${percentage}%`;
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: { weight: 'bold', size: 10 },
                        anchor: 'end',
                        align: 'end',
                        offset: 4,
                        formatter: (value) => {
                            const percentage = ((value / total) * 100).toFixed(1);
                            return percentage + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>

</body>
</html>