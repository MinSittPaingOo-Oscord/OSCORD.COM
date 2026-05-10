<style>
        .modal.fade .modal-dialog .modal-content {
            background: rgba(28, 37, 38, 0.6) !important; /* Dark glassy base */
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            border: 1px solid rgba(0, 242, 255, 0.3) !important;
            border-radius: 16px !important;
            box-shadow: 0 8px 32px rgba(0, 242, 255, 0.2) !important;
            color: #e6e6e6;
        }

        .modal-backdrop {
            background-color: rgba(10, 10, 10, 0.85) !important;
        }

        .modal-header {
            border-bottom: 1px solid #444;
        }

        .modal-title {
            color: #00f2ff;
            font-family: 'Orbitron', sans-serif;
            font-weight: 600;
        }

        .modal .btn-close {
            filter: invert(1);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .modal .btn-close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }

        .modal .form-label {
            color: #d0d0d0;
            font-weight: 500;
        }

        .modal .form-control {
            background: #333;
            border: 1px solid #555;
            color: #e6e6e6;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .modal .form-control:focus {
            border-color: #ff00ff;
            box-shadow: 0 0 0 4px rgba(255, 0, 255, 0.3);
        }

        .modal .btn-dark {
            background: #ff00ff;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .modal .btn-dark:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        /* --- NEW CLASS: Glassy Card Body Style --- */
        .glassy-card-body {
            background-color:transparent;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 20px;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

</style>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Passcode</label>
                        <input type="password" class="form-control" id="password" required>
                        <input type="hidden" id="courseID" name="courseID" value="<?php echo htmlspecialchars($id); ?>">
                        <input type="hidden" id="targetTab" name="targetTab" value="">
                    </div>
                    <button type="submit" class="btn btn-dark w-100" id="loginButton">Login</button>
                    <div id="loginLoading" class="text-center mt-2" style="display: none;">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div id="loginError" class="text-danger mt-2" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById("privateLectureVideo").addEventListener("click", function(event) {
            const isLoggedIn = false; // Replace with actual login check if available
            if (!isLoggedIn) {
                event.preventDefault();
                document.getElementById("targetTab").value = "privateLectureVideo";
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            }
        });

        document.getElementById("documents").addEventListener("click", function(event) {
            const isLoggedIn = false; // Replace with actual login check if available
            if (!isLoggedIn) {
                event.preventDefault();
                document.getElementById("targetTab").value = "documents";
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            }
        });

        document.getElementById("lectureLinks").addEventListener("click", function(event) {
            const isLoggedIn = false; // Replace with actual login check if available
            if (!isLoggedIn) {
                event.preventDefault();
                document.getElementById("targetTab").value = "lectureLinks";
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            }
        });

        document.getElementById("loginForm").addEventListener("submit", async function(event) {
            event.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const courseID = document.getElementById("courseID").value;
            const targetTab = document.getElementById("targetTab").value;
            const loginError = document.getElementById("loginError");
            const loginButton = document.getElementById("loginButton");
            const loginLoading = document.getElementById("loginLoading");

            loginError.style.display = "none";
            loginButton.disabled = true;
            loginLoading.style.display = "block";

            try {
                const response = await fetch("oscord_login.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&courseID=${encodeURIComponent(courseID)}`,
                    signal: AbortSignal.timeout(5000) // 5-second timeout
                });

                const loginApprove = await response.text();
                if (loginApprove === "true") {
                    alert("Login successful!");
                    const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                    loginModal.hide();
                    if (targetTab === "documents") {
                        document.getElementById("unlockeddocuments").style.display = "block";
                        const documentsTab = new bootstrap.Tab(document.getElementById('documents'));
                        documentsTab.show();
                    } else if (targetTab === "privateLectureVideo") {
                        document.getElementById("unlockedcontent").style.display = "block";
                        const privateLectureTab = new bootstrap.Tab(document.getElementById('privateLectureVideo'));
                        privateLectureTab.show();
                    }
                    else if (targetTab === "lectureLinks") {
                        document.getElementById("unlockedlecturelinks").style.display = "block";
                        const lectureLinksTab = new bootstrap.Tab(document.getElementById('lectureLinks'));
                        lectureLinksTab.show();
                    }
                } else {
                    loginError.textContent = "Invalid email or password. Please try again.";
                    loginError.style.display = "block";
                }
            } catch (error) {
                loginError.textContent = "Login failed. Please check your connection and try again.";
                loginError.style.display = "block";
            } finally {
                loginButton.disabled = false;
                loginLoading.style.display = "none";
            }
        });
    });
</script>