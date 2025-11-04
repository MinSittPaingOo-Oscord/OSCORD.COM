<style>

    #oscord-cert-section {
        background-color : transparent;
        padding: 80px 0;
        color: #ffffff;
        margin-top : -100px !important;
        margin-bottom:0px !important;
    }

    #oscord-cert-content h1 {
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 30px;
        line-height: 1.5;
        color: #ffffff;
    }

    #oscord-cert-content p {
        font-size: 1.3rem;
        line-height: 1.8;
        margin-bottom: 30px;
        max-width: 600px;
        color: #e6e6e6;
        font-family : 'Calibri' !important;
    }

    #oscord-cert-image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 0 !important;
    }

    #oscord-cert-btn {
        border: 1px;
        padding: 15px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color .3s ease, transform .3s ease;
        text-decoration: none;
        display: inline-block;
        background: transparent;
        border: 2px solid #00f2ff;
        color: #00f2ff;
        animation: neonGlow 2s infinite;
        border-radius : 40px;
    }

    #oscord-cert-btn:hover {
        background-color: #00f2ff;
        transform: translateY(-3px);
        color:rgb(0, 0, 0);
    }

    @media (max-width: 991px) {
        #oscord-cert-content {
            text-align: center;
            margin-bottom: 50px;
        }
        #oscord-cert-content h1 {font-size:3rem; text-align : left; margin-left : 20px;}
        #oscord-cert-content p {font-size:1.5rem;max-width:90%;margin-left:auto;margin-right:auto;font-family :'Calibri' !important; text-align :left}
        #oscord-cert-image-container {height:auto; margin-top:-30px !important}
        #oscord-cert-placeholder {min-height:300px;max-width:80%;}
    }

    @media (max-width: 576px) {
        #oscord-cert-content h1 {font-size:2.2rem;}
        #oscord-cert-content p {font-size:1.2rem;}
        #oscord-cert-btn {padding:12px 25px;font-size:1rem;}
        #oscord-cert-placeholder {min-height:250px;font-size:1.2rem;}
    }
</style>

<section id="oscord-cert-section">
    <div class="container">
        <div class="row align-items-center">

            <!-- TEXT COLUMN -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div id="oscord-cert-content">
                    <h1>Certificate Of Completion</h1>
                    <p>At Oscord Code Academy, we award digital certificates to students who successfully complete all assignments, projects, and exams for each of our courses. Our training focuses on building your programming and software development skills through hands-on assignments, exams, and practical projects, with expert instructors guiding you throughout the entire course.</p>
                    <a href="#" id="oscord-cert-btn">Start Learning</a>
                </div>
            </div>

            <!-- IMAGE COLUMN -->
            <div class="col-lg-6">
                <div id="oscord-cert-image-container">
                    <img src="./image/certificate.png"
                         alt="Oscord Code Academy Certificate"
                         id="oscord-cert-placeholder"
                         class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('oscord-cert-btn');
        if (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    });
</script>