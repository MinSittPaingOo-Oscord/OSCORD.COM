<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connectdb.php';

// Ensure database connection
if (!$conn || $conn->connect_error) {
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
}

// Initialize arrays
$courseData = [];
$countries = [];
$courseNames = [];
$countryTotals = [];
$ageLabels = [];
$ageData = [];

// Fetch data for Courses x Students by Country
$query = "
    SELECT 
        c.courseName,
        s.studentCountry,
        COUNT(*) as student_count
    FROM oscord_studentxcourse sc
    JOIN oscord_student s ON sc.studentID = s.studentID
    JOIN oscord_course c ON sc.courseID = c.courseID
    GROUP BY c.courseName, s.studentCountry
";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "<p>Error in course query: " . mysqli_error($conn) . "</p>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $course = $row['courseName'];
        $country = $row['studentCountry'];
        $count = $row['student_count'];

        if (!in_array($course, $courseNames)) {
            $courseNames[] = $course;
        }
        if (!in_array($country, $countries)) {
            $countries[] = $country;
        }

        if (!isset($courseData[$course])) {
            $courseData[$course] = [];
        }
        $courseData[$course][$country] = $count;
    }
}

// Prepare data for first Chart.js
$datasets = [];
$colors = [
    '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#4CAF50', '#9C27B0', '#F44336', '#3F51B5',
    '#E91E63', '#2196F3', '#FFC107', '#00BCD4', '#673AB7', '#FF5722', '#8BC34A', '#AB47BC', '#D81B60', '#03A9F4', '#FF6384',
    '#1A3C8C', '#F4A261', '#2E7D32', '#AD1457', '#0288D1', '#FF7043', '#6D4C41', '#8E24AA', '#00E676',
    '#D81B60', '#1976D2', '#FFB300', '#26A69A', '#5E35B1', '#EF6C00', '#43A047', '#8D6E63', '#039BE5',
    '#F06292', '#1565C0', '#FFCA28', '#00695C', '#4527A0', '#F4511E', '#388E3C', '#4E342E', '#00ACC1',
    '#EC407A', '#0D47A1', '#FFD54F', '#00796B', '#311B92', '#BF360C', '#2E7D32', '#5D4037', '#0097A7',
    '#F48FB1', '#82B1FF', '#FFECB3', '#004D40', '#1A237E', '#E64A19', '#1B5E20', '#3E2723', '#00BCD4',
    '#CE93D8', '#448AFF', '#FFE0B2', '#00695C', '#283593', '#D84315', '#388E3C', '#4E342E', '#26C6DA',
    '#AB47BC', '#2979FF', '#FFCC80', '#00796B', '#303F9F', '#BF360C', '#2E7D32', '#3E2723', '#00E5FF',
    '#BA68C8', '#2962FF', '#FFD180', '#00695C', '#3F51B5', '#FF5722', '#1B5E20', '#4E342E', '#18FFFF',
    '#9575CD', '#1E88E5', '#FFE0B2', '#004D40', '#5C6BC0', '#F4511E', '#388E3C', '#3E2723', '#B2EBF2',
    '#7E57C2', '#039BE5', '#FFCCBC', '#00695C', '#7986CB', '#EF6C00', '#2E7D32', '#4E342E', '#80DEEA',
    '#673AB7', '#0288D1', '#FFAB91', '#00796B', '#9FA8DA', '#D81B60', '#1B5E20', '#3E2723', '#4DD0E1',
    '#512DA8', '#0277BD', '#FF8A65', '#004D40', '#C5CAE9', '#AD1457', '#388E3C', '#4E342E', '#26A69A',
    '#4527A0', '#01579B', '#FF7043', '#00695C', '#EDE7F6', '#880E4F', '#2E7D32', '#3E2723', '#00BCD4',
    '#311B92', '#00695C', '#FF5722', '#00796B', '#D1C4E9', '#C2185B', '#1B5E20', '#4E342E', '#4CAF50',
    '#1A237E', '#004D40', '#F4511E', '#00695C', '#B39DDB', '#E91E63', '#388E3C', '#3E2723', '#8BC34A',
    '#283593', '#00695C', '#EF6C00', '#00796B', '#9575CD', '#D81B60', '#2E7D32', '#4E342E', '#CDDC39',
    '#303F9F', '#004D40', '#D84315', '#00695C', '#7E57C2', '#AD1457', '#1B5E20', '#3E2723', '#AFB42B',
    '#3F51B5', '#00695C', '#BF360C', '#00796B', '#673AB7', '#880E4F', '#388E3C', '#4E342E', '#9E9D24',
    '#5C6BC0', '#004D40', '#E64A19', '#00695C', '#512DA8', '#C2185B', '#2E7D32', '#3E2723', '#827717',
    '#7986CB', '#00695C', '#FF5722', '#00796B', '#4527A0', '#E91E63', '#1B5E20', '#4E342E', '#F9A825',
    '#9FA8DA', '#004D40', '#F4511E', '#00695C', '#311B92', '#D81B60', '#388E3C', '#3E2723', '#FFCA28',
    '#C5CAE9', '#00695C', '#EF6C00', '#00796B', '#1A237E', '#AD1457', '#2E7D32', '#4E342E', '#FFECB3',
    '#EDE7F6', '#004D40', '#D84315', '#00695C', '#283593', '#880E4F', '#1B5E20', '#3E2723', '#FFE0B2',
    '#D1C4E9', '#00695C', '#BF360C', '#00796B', '#303F9F', '#C2185B', '#388E3C', '#4E342E', '#FFCC80',
    '#B39DDB', '#004D40', '#E64A19', '#00695C', '#3F51B5', '#E91E63', '#2E7D32', '#3E2723', '#FFD180',
    '#9575CD', '#00695C', '#FF5722', '#00796B', '#5C6BC0', '#D81B60', '#1B5E20', '#4E342E', '#FFAB91',
    '#7E57C2', '#004D40', '#F4511E', '#00695C', '#7986CB', '#AD1457', '#388E3C', '#3E2723', '#FF8A65',
    '#673AB7', '#00695C', '#EF6C00', '#00796B', '#9FA8DA', '#880E4F', '#2E7D32', '#4E342E', '#FF7043'
];
$colorIndex = 0;

foreach ($countries as $country) {
    $dataset = [
        'label' => $country,
        'data' => array_map(function($course) use ($courseData, $country) {
            return isset($courseData[$course][$country]) ? $courseData[$course][$country] : 0;
        }, $courseNames),
        'backgroundColor' => $colors[$colorIndex % count($colors)]
    ];
    $datasets[] = $dataset;
    $colorIndex++;
}

$shortCourseNames = array_map(function($course) {
    return implode(' ', array_slice(explode(' ', $course), 0, 1));
}, $courseNames);

// Fetch data for Country vs Number of Students
$queryCountry = "
    SELECT 
        s.studentCountry,
        COUNT(DISTINCT sc.studentID) as total_students
    FROM oscord_studentxcourse sc
    JOIN oscord_student s ON sc.studentID = s.studentID
    GROUP BY s.studentCountry
";
$resultCountry = mysqli_query($conn, $queryCountry);
if (!$resultCountry) {
    echo "<p>Error in country query: " . mysqli_error($conn) . "</p>";
} else {
    while ($row = mysqli_fetch_assoc($resultCountry)) {
        $countryTotals[$row['studentCountry']] = $row['total_students'];
    }
}

$countryLabels = array_keys($countryTotals);
$countryData = array_values($countryTotals);

// Fetch data for Age vs Number of Students
$queryAge = "
    SELECT 
        FLOOR(DATEDIFF(CURDATE(), s.studentBirthday) / 365.25) as age,
        COUNT(DISTINCT s.studentID) as student_count
    FROM oscord_student s
    JOIN oscord_studentxcourse sc ON s.studentID = s.studentID
    WHERE s.studentBirthday IS NOT NULL AND s.studentBirthday <= CURDATE()
    GROUP BY age
    ORDER BY age
";
$resultAge = mysqli_query($conn, $queryAge);
if (!$resultAge) {
    echo "<p>Error in age query: " . mysqli_error($conn) . "</p>";
} else {
    while ($row = mysqli_fetch_assoc($resultAge)) {
        $ageLabels[] = $row['age'];
        $ageData[] = $row['student_count'];
    }
}

// Debugging output
// echo "<pre>";
// echo "Course Names: " . print_r($courseNames, true) . "\n";
// echo "Countries: " . print_r($countries, true) . "\n";
// echo "Country Totals: " . print_r($countryTotals, true) . "\n";
// echo "Age Labels: " . print_r($ageLabels, true) . "\n";
// echo "Age Data: " . print_r($ageData, true) . "\n";
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Distribution Chart - Oscord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <style>
        .btn-cyber {
            background: linear-gradient(45deg, #ff1493, #00ffea);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            color: #fff;
            font-weight: bold;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
            text-align: center;
            width: 100%;
            cursor: pointer;
        }
        .btn-cyber:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 255, 234, 0.7);
        }
        .btn-cyber::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
            border-radius: 50%;
        }
        .btn-cyber:hover::before {
            width: 300%;
            height: 300%;
        }
        body {
            font-family: 'Calibri', sans-serif;
            background: linear-gradient(135deg, #0d0d2b 0%, #2a0a4e 100%);
            min-height: 100vh;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
            color: #e0e0ff;
        }
        canvas#particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .cyber-card {
            background: rgba(20, 20, 40, 0.3);
            backdrop-filter: blur(15px);
            border-radius: 1.5rem;
            border: 2px solid rgba(255, 20, 147, 0.5);
            box-shadow: 0 0 20px rgba(255, 20, 147, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .cyber-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(255, 20, 147, 0.5);
        }
        canvas#courseChart, canvas#countryChart, canvas#ageChart {
            width: 100% !important;
            max-width: 100%;
            height: 400px !important;
        }
        @media (max-width: 1024px) {
            body { padding: 0.75rem; }
            .cyber-card { padding: 1rem; margin-bottom: 1rem; }
            canvas#courseChart, canvas#countryChart, canvas#ageChart { height: 350px !important; min-width: auto; }
            h1 { font-size: 2.5rem; }
        }
        @media (max-width: 640px) {
            body { background: black; padding: 0.5rem; font-size: 0.875rem; }
            .cyber-card { padding: 0.75rem; border-radius: 1rem; }
            canvas#courseChart, canvas#countryChart, canvas#ageChart { height: 300px !important; min-width: auto; }
            h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="container mx-auto">
        <div class="cyber-card">
            <h1 class="text-5xl font-bold text-white mb-4">Insights</h1>
            <?php if (empty($courseNames)) { ?>
                <p>No course data available.</p>
            <?php } else { ?>
                <canvas id="courseChart"></canvas>
            <?php } ?>
        </div>
        <div class="cyber-card">
            <?php if (empty($countryLabels)) { ?>
                <p>No country data available.</p>
            <?php } else { ?>
                <canvas id="countryChart"></canvas>
            <?php } ?>
        </div>
        <div class="cyber-card">
            <?php if (empty($ageLabels)) { ?>
                <p>No age data available.</p>
            <?php } else { ?>
                <canvas id="ageChart"></canvas>
            <?php } ?>
        </div>
        <a href="admin_dashboard.php" class="btn-cyber">Back to Dashboard</a>
    </div>

    <script>
        // Particle animation
        const particleCanvas = document.getElementById('particles');
        const particleCtx = particleCanvas.getContext('2d');
        particleCanvas.width = window.innerWidth;
        particleCanvas.height = window.innerHeight;

        const particles = [];
        const particleCount = 20;

        class Particle {
            constructor() {
                this.x = Math.random() * particleCanvas.width;
                this.y = Math.random() * particleCanvas.height;
                this.size = Math.random() * 2 + 1;
                this.speedX = Math.random() * 0.5 - 0.25;
                this.speedY = Math.random() * 0.5 - 0.25;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.x < 0 || this.x > particleCanvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > particleCanvas.height) this.speedY *= -1;
            }
            draw() {
                particleCtx.fillStyle = 'rgba(0, 255, 234, 0.5)';
                particleCtx.beginPath();
                particleCtx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                particleCtx.fill();
            }
        }

        function initParticles() {
            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }
        }

        function animateParticles() {
            particleCtx.clearRect(0, 0, particleCanvas.width, particleCanvas.height);
            particles.forEach(particle => {
                particle.update();
                particle.draw();
            });
            requestAnimationFrame(animateParticles);
        }

        initParticles();
        animateParticles();

        window.addEventListener('resize', () => {
            particleCanvas.width = window.innerWidth;
            particleCanvas.height = window.innerHeight;
        });

        // Chart.js configuration for Courses x Students by Country
        <?php if (!empty($courseNames)) { ?>
        const ctxCourse = document.getElementById('courseChart').getContext('2d');
        new Chart(ctxCourse, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($shortCourseNames); ?>,
                datasets: <?php echo json_encode($datasets); ?>
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Courses x Students by Country',
                        color: '#e0e0ff',
                        font: {
                            family: 'Calibri',
                            size: window.innerWidth <= 640 ? 24 : window.innerWidth <= 1024 ? 30 : 40,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(20, 20, 40, 0.9)',
                        borderColor: '#ff1492',
                        borderWidth: 2,
                        titleColor: '#00ffea',
                        bodyColor: '#e0e0ff',
                        titleFont: { size: window.innerWidth <= 640 ? 12 : 14 },
                        bodyFont: { size: window.innerWidth <= 640 ? 12 : 14 }
                    },
                    legend: {
                        labels: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Courses',
                            color: '#00ffea',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        },
                        ticks: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 12 : window.innerWidth <= 1024 ? 14 : 16,
                                lineHeight: 1.5
                            },
                            padding: 10,
                            maxRotation: 0,
                            minRotation: 0,
                            autoSkip: true
                        },
                        grid: {
                            color: 'rgba(255, 20, 147, 0.2)'
                        }
                    },
                    y: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Number of Students',
                            color: '#00ffea',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        },
                        ticks: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 12 : window.innerWidth <= 1024 ? 14 : 16,
                                lineHeight: 1.5
                            },
                            padding: 10
                        },
                        grid: {
                            color: 'rgba(255, 20, 147, 0.2)'
                        },
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: { top: 10, bottom: 40, left: 10, right: 10 }
                }
            }
        });
        <?php } ?>

        // Chart.js configuration for Students by Country
        <?php if (!empty($countryLabels)) { ?>
        const ctxCountry = document.getElementById('countryChart').getContext('2d');
        new Chart(ctxCountry, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($countryLabels); ?>,
                datasets: [{
                    label: 'Total Students',
                    data: <?php echo json_encode($countryData); ?>,
                    backgroundColor: '#9966FF'
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Students by Country',
                        color: '#e0e0ff',
                        font: {
                            family: 'Calibri',
                            size: window.innerWidth <= 640 ? 24 : window.innerWidth <= 1024 ? 30 : 40,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(20, 20, 40, 0.9)',
                        borderColor: '#ff1492',
                        borderWidth: 2,
                        titleColor: '#9966FF',
                        bodyColor: '#e0e0ff',
                        titleFont: { size: window.innerWidth <= 640 ? 12 : 14 },
                        bodyFont: { size: window.innerWidth <= 640 ? 12 : 14 }
                    },
                    legend: {
                        labels: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Countries',
                            color: '#00ffea',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        },
                        ticks: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 12 : window.innerWidth <= 1024 ? 14 : 16,
                                lineHeight: 1.5
                            },
                            padding: 10,
                            maxRotation: 0,
                            minRotation: 0,
                            autoSkip: true
                        },
                        grid: {
                            color: 'rgba(255, 20, 147, 0.2)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Students',
                            color: '#00ffea',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        },
                        ticks: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 12 : window.innerWidth <= 1024 ? 14 : 16,
                                lineHeight: 1.5
                            },
                            padding: 10
                        },
                        grid: {
                            color: 'rgba(255, 20, 147, 0.2)'
                        },
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: { top: 10, bottom: 40, left: 10, right: 10 }
                }
            }
        });
        <?php } ?>

        // Chart.js configuration for Students by Age
        <?php if (!empty($ageLabels)) { ?>
        const ctxAge = document.getElementById('ageChart').getContext('2d');
        new Chart(ctxAge, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($ageLabels); ?>,
                datasets: [{
                    label: 'Total Students',
                    data: <?php echo json_encode($ageData); ?>,
                    backgroundColor: '#9966FF'
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Students by Age',
                        color: '#e0e0ff',
                        font: {
                            family: 'Calibri',
                            size: window.innerWidth <= 640 ? 24 : window.innerWidth <= 1024 ? 30 : 40,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(20, 20, 40, 0.9)',
                        borderColor: '#ff1492',
                        borderWidth: 2,
                        titleColor: '#00ffea',
                        bodyColor: '#e0e0ff',
                        titleFont: { size: window.innerWidth <= 640 ? 12 : 14 },
                        bodyFont: { size: window.innerWidth <= 640 ? 12 : 14 }
                    },
                    legend: {
                        labels: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Age',
                            color: '#00ffea',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        },
                        ticks: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 12 : window.innerWidth <= 1024 ? 14 : 16,
                                lineHeight: 1.5
                            },
                            padding: 10,
                            maxRotation: 0,
                            minRotation: 0,
                            autoSkip: true
                        },
                        grid: {
                            color: 'rgba(255, 20, 147, 0.2)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Students',
                            color: '#00ffea',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 16 : window.innerWidth <= 1024 ? 20 : 24
                            }
                        },
                        ticks: {
                            color: '#e0e0ff',
                            font: {
                                family: 'Calibri',
                                size: window.innerWidth <= 640 ? 12 : window.innerWidth <= 1024 ? 14 : 16,
                                lineHeight: 1.5
                            },
                            padding: 10
                        },
                        grid: {
                            color: 'rgba(255, 20, 147, 0.2)'
                        },
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: { top: 10, bottom: 40, left: 10, right: 10 }
                }
            }
        });
        <?php } ?>
    </script>
</body>
</html>