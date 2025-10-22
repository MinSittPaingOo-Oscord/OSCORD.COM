<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OSCORD Navbar</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* =========================
   Animations
========================= */
@keyframes fadeIn { from {opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }
@keyframes slideIn { from {transform:translateX(-100%);} to {transform:translateX(0);} }
@keyframes fadeUp { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }

/* =========================
   Navbar
========================= */
.navbar-custom {
    background: rgba(10,10,10,0.6);
    backdrop-filter: blur(25px) saturate(200%);
    -webkit-backdrop-filter: blur(25px) saturate(200%);
    border: 2px solid rgba(0,242,255,0.35);
    border-radius: 18px;
    padding: 12px 20px;
    position: sticky;
    top: 1px;
    z-index: 1000;
    height:70px;
    box-shadow: 0 0 30px rgba(0,242,255,0.3), inset 0 0 15px rgba(0,242,255,0.1);
    display: flex;
    align-items: center;
    gap: 18px;
}

.nav-left { display:flex; align-items:center; gap:18px; }
.nav-right { margin-left:auto; display:flex; align-items:center; gap:12px; }

.brand {
    color:#e8ffff; font-family:'Calibri',sans-serif; font-weight:600; font-size:1.05rem; text-decoration:none; padding:6px 8px;
}

.nav-list { display:flex; align-items:center; gap:14px; list-style:none; padding:0; margin:0; }
.nav-item { display:inline-flex; align-items:center; position:relative; }
.nav-link {
    color:#e8ffff !important;
    font-family:'Calibri',sans-serif;
    font-weight:400;
    font-size:1.05rem;
    position:relative;
    letter-spacing:0.5px;
    transition: all 0.3s ease;
    text-decoration:none;
    padding:6px 10px;
    cursor:pointer;
}
.nav-link:hover { color:#00f2ff !important; transform:translateY(-2px); text-shadow:0 0 10px #00f2ff,0 0 25px #00f2ff; }
.nav-link.active { color:#00f2ff !important; text-shadow:0 0 12px #00f2ff,0 0 25px #00f2ff; }

/* Dropdown menu */
.dropdown-menu {
    display:none;
    position:absolute;
    top:100%;
    left:0;
    background: rgba(10,10,10,0.6);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border:2px solid rgba(0,242,255,0.3);
    border-radius:12px;
    box-shadow: 0 8px 30px rgba(0,242,255,0.25), inset 0 0 15px rgba(0,242,255,0.1);
    z-index:1500;
    min-width:200px;
}
.dropdown-menu.show { display:block; }

.dropdown-item {
    color:#e8ffff;
    font-size:1rem;
    font-family:'Calibri',sans-serif;
    padding:10px 20px;
    transition: all 0.3s ease;
    border-radius:6px;
    display:block;
    text-decoration:none;
}
.dropdown-item:hover {
    background: rgba(0,242,255,0.3);
    color:#00f2ff;
    transform:translateX(1px);
    text-shadow:0 0 8px #00f2ff,0 0 15px #00f2ff;
}

/* =========================
   Hamburger (mobile)
========================= */
.navbar-toggler {
    display: none;
    border: none;
    background: transparent;
    cursor: pointer;
    flex-direction: column;
    gap:5px;
    padding:6px;
}
.navbar-toggler span {
    display: block;
    width: 26px;
    height: 2px;
    background-color: #00f2ff;
    transition: all 0.3s ease;
}

@media(max-width:768px){
    .navbar-toggler{ display:flex; }
    .nav-list{ display:none; }
}

/* =========================
   Mobile Overlay
========================= */
.overlay { position:fixed; inset:0; display:none; align-items:center; justify-content:center; z-index:2000; backdrop-filter: blur(22px) saturate(200%); }
.overlay.active { display:flex; animation:fadeIn 0.25s ease-out; }

.overlay-panel { width:100%; height:100%; background: rgba(10,10,10,0.65); display:flex; flex-direction:column; align-items:center; padding:40px 24px; }
.overlay-box { width:100%; max-width:820px; border-radius:16px; padding:26px; background: rgba(10,10,10,0.6); border:2px solid rgba(0,242,255,0.35); display:flex; flex-direction:column; gap:10px; }
.overlay-top { display:flex; justify-content:space-between; align-items:center; gap:12px; }
.overlay-title { color:#e8ffff; font-family:'Calibri',sans-serif; font-size:1.1rem; font-weight:600; text-decoration:none; }
.overlay-close { background:transparent; border:1px solid rgba(232,255,255,0.06); border-radius:8px; padding:8px; cursor:pointer; color:#e8ffff; font-size:18px; line-height:1; }
.overlay-nav { display:flex; flex-direction:column; gap:12px; margin-top:18px; }
.overlay-nav a { display:block; text-decoration:none; padding:14px 18px; border-radius:10px; font-family:'Calibri',sans-serif; font-size:1.05rem; color:#e8ffff; background: rgba(255,255,255,0.02); transition: transform 0.18s ease, background 0.18s ease; animation:fadeUp 0.28s ease both; }
.overlay-nav a:hover { background: rgba(0,242,255,0.12); transform:translateY(-4px); color:#00f2ff; text-shadow:0 0 8px #00f2ff; }
.overlay-footer { margin-top:auto; font-size:0.9rem; color: rgba(232,255,255,0.7); }

/* Accordion */
.accordion-toggle { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:14px 18px; border-radius:10px; background: rgba(255,255,255,0.02); cursor:pointer; border:none; width:100%; color:#e8ffff; font-family:'Calibri',sans-serif; font-size:1.05rem; }
.accordion-chevron { transition: transform 0.22s ease; font-size:0.95rem; opacity:0.95; }
.accordion-panel { max-height:0; overflow:hidden; transition:max-height 0.28s ease; display:flex; flex-direction:column; gap:8px; margin-left:8px; }
.accordion-panel.open { max-height:400px; padding-top:8px; padding-bottom:8px; }
.accordion-panel a { padding:10px 14px; border-radius:8px; color:#e8ffff; text-decoration:none; font-size:0.98rem; }
.accordion-panel a:hover { background: rgba(0,242,255,0.08); color:#00f2ff; }
/* Move desktop dropdown 10px to the left */
.nav-item.dropdown .dropdown-menu {
    left: -40px; /* shift 10px left */
}

</style>
</head>
<body>

<nav class="navbar-custom" role="navigation" aria-label="Main navigation">
    <div class="nav-left">
        <a class="brand nav-link" href="oscord_home.php">OSCORD Code Academy</a>
    </div>
    <div class="nav-right">
        <ul class="nav-list">
            <li class="nav-item"><a class="nav-link" href="coursePage.php">Courses</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link" id="blogDropdown">Blogs</a>
                <ul class="dropdown-menu" id="blogMenu">
                    <li><a class="dropdown-item" href="oscord_startLearningProgramming.php">How to start learning programming ?</a></li>
                    <li><a class="dropdown-item" href="oscord_webDevelopment.php">Full stack web developer guide</a></li>
                    <li><a class="dropdown-item" href="oscord_database.php">Database basics</a></li>
                    <li><a class="dropdown-item" href="oscord_AI.php">AI & Machine Learning</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" id="settingDropdown">Setting</a>
                <ul class="dropdown-menu" id="settingMenu">
                    <li><a class="dropdown-item" href="oscord_instructorControlLogin.php">Instructor</a></li>
                    <li><a class="dropdown-item" href="oscord_studentControlLogin.php">Student</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="oscord_signUpPage.php">Sign Up</a></li>
        </ul>

        <!-- Mobile Hamburger -->
        <button id="hamburgerBtn" class="navbar-toggler" aria-controls="mobileOverlay" aria-expanded="false" aria-label="Open menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

<!-- MOBILE OVERLAY -->
<div id="mobileOverlay" class="overlay">
    <div class="overlay-panel" tabindex="-1">
        <div class="overlay-box">
            <div class="overlay-top">
                <a class="overlay-title" href="oscord_home.php">OSCORD Code Academy</a>
                <button id="overlayClose" class="overlay-close">&times;</button>
            </div>
            <nav class="overlay-nav">
                <a href="coursePage.php">Courses</a>
                <button id="blogsToggle" class="accordion-toggle">Blogs <span class="accordion-chevron">▶</span></button>
                <div id="blogsPanel" class="accordion-panel">
                    <a href="oscord_startLearningProgramming.php">How to start learning programming ?</a>
                    <a href="oscord_webDevelopment.php">Full stack web developer guide</a>
                    <a href="oscord_database.php">Database basics</a>
                    <a href="oscord_AI.php">AI & Machine Learning</a>
                </div>
                <a href="oscord_instructorControlLogin.php">Instructor</a>
                <a href="oscord_studentControlLogin.php">Student</a>
                <a href="oscord_signUpPage.php">Sign Up</a>
            </nav>
            
        </div>
    </div>
</div>

<script>
// MOBILE OVERLAY
(function(){
    const hamburger = document.getElementById('hamburgerBtn');
    const overlay = document.getElementById('mobileOverlay');
    const closeBtn = document.getElementById('overlayClose');

    function openOverlay(){ overlay.classList.add('active'); document.documentElement.style.overflow='hidden'; document.body.style.overflow='hidden'; }
    function closeOverlay(){ overlay.classList.remove('active'); document.documentElement.style.overflow=''; document.body.style.overflow=''; }

    hamburger.addEventListener('click',()=>{ overlay.classList.contains('active') ? closeOverlay() : openOverlay(); });
    closeBtn.addEventListener('click',closeOverlay);
    overlay.addEventListener('click', e => { if(e.target === overlay) closeOverlay(); });
    window.addEventListener('resize', ()=>{ if(window.innerWidth>768 && overlay.classList.contains('active')) closeOverlay(); });

    // Mobile accordion
    const blogsToggle = document.getElementById('blogsToggle');
    const blogsPanel = document.getElementById('blogsPanel');
    const blogsChevron = blogsToggle.querySelector('.accordion-chevron');
    blogsToggle.addEventListener('click', ()=> {
        const open = blogsPanel.classList.toggle('open');
        blogsChevron.style.transform = open ? 'rotate(90deg)' : 'rotate(0deg)';
    });

    // DESKTOP DROPDOWN CLICK
    function setupDropdown(linkId, menuId){
        const link = document.getElementById(linkId);
        const menu = document.getElementById(menuId);

        link.addEventListener('click', e=>{
            e.preventDefault();
            menu.classList.toggle('show');
        });

        // close when clicking outside
        document.addEventListener('click', e=>{
            if(!link.contains(e.target) && !menu.contains(e.target)){
                menu.classList.remove('show');
            }
        });
    }

    setupDropdown('blogDropdown','blogMenu');
    setupDropdown('settingDropdown','settingMenu');
})();
</script>

</body>
</html>
