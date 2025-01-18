<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .footer {
            background-color: #1B3A57; /* Dark Blue */
            color: white;
            padding: 20px 0;
            font-size: 14px;
            border-top: 1px solid #3B5B78;
        }

        .footer .navbar-text {
            font-weight: 500;
            font-size: 15px;
        }

        .footer a {
            color: #AEDFF7; /* Light Blue */
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #FFFFFF; /* White */
        }

        .footer .social-icons a {
            display: inline-block;
            width: 35px;
            height: 35px;
            margin: 0 8px;
            line-height: 35px;
            border-radius: 50%;
            background-color: #3B5B78; /* Slightly lighter blue for contrast */
            text-align: center;
            color: #FFD700; /* Gold color for icons */
            font-size: 18px;
            transition: background-color 0.3s, color 0.3s;
        }

        .footer .social-icons a:hover {
            background-color: #0073E6; /* Bright Blue */
            color: #FFD700; /* Keep icons gold on hover */
        }

        .footer .navbar-nav-link {
            display: inline-flex;
            align-items: center;
        }

        .footer .navbar-nav-link i {
            margin-right: 5px;
            color: white; /* Ensure icons in links are visible */
        }

        .footer .navbar-toggler {
            border: none;
            background: transparent;
            color: white;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left">
                    <span class="navbar-text">
                        &copy; {{ date('Y') }} <a href="#" style="color: #AEDFF7;">{{ Qs::getSystemName() }}</a> by <a href="#" style="color: #AEDFF7;">Rangishuri</a>. All rights reserved.
                    </span>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <ul class="navbar-nav ml-lg-auto">
                        <li class="nav-item d-inline">
                            <a href="{{ route('privacy_policy') }}" class="navbar-nav-link" target="_blank">
                                <i class="icon-lifebuoy"></i> Privacy Policy
                            </a>
                        </li>
                        <li class="nav-item d-inline">
                            <a href="{{ route('terms_of_use') }}" class="navbar-nav-link" target="_blank">
                                <i class="icon-file-text2"></i> Terms of Use
                            </a>
                        </li>
                    </ul>
                    <div class="social-icons mt-2">
                        <a href="https://facebook.com" target="_blank" class="fab fa-facebook"></a>
                        <a href="https://twitter.com" target="_blank" class="fab fa-twitter"></a>
                        <a href="https://linkedin.com" target="_blank" class="fab fa-linkedin"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
