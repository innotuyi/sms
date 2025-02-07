<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Ensures the footer sticks to the bottom */
        margin: 0;
    }

    .content {
        flex: 1; /* Pushes the footer down */
    }

    footer {
        background-color: #002C5C;
        color: white;
        padding: 13px 0;
    }

    .footer-container {
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .footer-section {
        flex: 1;
        min-width: 250px;
        padding: 10px;
    }

    .footer-section h3 {
        margin-bottom: 10px;
    }

    .footer-section p, .footer-section a {
        color: white;
        text-decoration: none;
    }

    .social-icons a {
        color: white;
        margin-right: 10px;
    }

    .copyright {
        text-align: center;
        padding: 20px;
        background-color: #002C5C;
    }
</style>

<div class="content">
    <!-- Your Page Content Goes Here -->
</div>

<footer>
    <div class="footer-container">
        <!-- Left Section (Description) -->
        <div class="footer-section">
            <p>Sure! Imagine a website designed to assist students in choosing the right school based on location and specialization.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- Middle Section (Services) -->
        <div class="footer-section">
            <h3>Services</h3>
            <ul style="list-style: none; padding: 0;">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">How it works</a></li>
            </ul>
        </div>

        <!-- Right Section (Contact) -->
        <div class="footer-section">
            <h3>Get In Touch</h3>
            <p><i class="fas fa-map-marker-alt"></i> KN 224 St-Kigali</p>
            <p><i class="fas fa-envelope"></i> contact@rangishuri.rw</p>
            <p><i class="fas fa-phone"></i> +250 788 861 433</p>
            <p><i class="fas fa-clock"></i> Mon-Fri 9:00AM - 5:00PM</p>
        </div>
    </div>

    <!-- Copyright Section (Always at Bottom) -->
    <div class="copyright">
        <p>&copy; 2024 Rangishuri All Rights Reserved.</p>
    </div>
</footer>
