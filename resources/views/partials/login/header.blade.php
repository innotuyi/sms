<!DOCTYPE html>
<html lang="en">
<head>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
        }

        /* Navigation Bar Styling */
        .navbar {
            background-color: #1B3A57; /* Dark blue */
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .brand {
            font-size: 24px; 
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .brand .banner-text {
            margin-left: 10px;
            font-size: 14px; 
            color: #AEDFF7; 
            font-style: italic;
            background: rgba(255, 255, 255, 0.1);
            padding: 4px 8px; 
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(255, 255, 255, 0.2);
        }

        .auth-links {
            display: flex;
            gap: 10px;
        }

        .auth-links a {
            color: white;
            text-decoration: none;
            padding: 6px 12px;
            background-color: #2D5069;
            border-radius: 4px;
            text-align: center;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .auth-links a:hover {
            background-color: #AEDFF7;
            color: #1B3A57;
        }

        /* Region Dropdown Styling */
        .region-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px auto;
            justify-content: center;
            padding: 10px;
        }

        .region-links .dropdown {
            position: relative;
            display: inline-block;
            width: 200px;
        }

        .dropdown .dropbtn {
            width: 100%;
            padding: 10px;
            background-color: #1B3A57;
            color: white;
            border: none;
            cursor: pointer;
            text-align: left;
            font-size: 16px;
        }

        .dropdown .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #AEDFF7;
            min-width: 180px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1;
            padding: 10px 0;
            border-radius: 5px;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            color: #1B3A57;
            background-color: #AEDFF7;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            display: block;
        }

        .dropdown-menu a:hover {
            color: #AEDFF7;
            background-color: #1B3A57;
            transform: scale(1.05);
        }

        /* Show schools under each district */
        .district {
            position: relative;
            display: inline-block;
            width: 100%;
            margin: 5px 0;
        }

        .district-schools {
            display: none;
            position: absolute;
            left: 105%; /* Position to the right of the district */
            top: 0;
            background-color: transparent; /* Remove dark blue background */
            padding: 10px;
            border-radius: 4px;
            color: #1B3A57;
            max-width: 350px; /* Adjust max-width to give more room */
            z-index: 2;
            visibility: hidden; /* Initially hidden */
            opacity: 0; /* For smooth transition */
            transition: opacity 0.3s ease-in-out;
            box-shadow: none; /* Remove shadow */
        }

        .district:hover .district-schools {
            display: block;
            visibility: visible;
            opacity: 1; /* Fade-in effect */
        }

        .district-schools a {
            color: #1B3A57;
            padding: 8px 12px;
            text-decoration: none;
            display: block;
            font-weight: normal;
            margin-bottom: 5px; /* Add breathing space between school names */
            border-radius: 4px;
            white-space: nowrap; /* Prevent wrapping of school names */
        }

        .district-schools a:hover {
            background-color: #AEDFF7;
            color: white;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .brand {
                flex-direction: column;
                align-items: flex-start;
            }

            .auth-links {
                flex-direction: row;
                gap: 10px;
            }

            .region-links {
                flex-direction: column;
                align-items: center;
            }

            .dropdown .dropbtn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<!-- Navigation Bar with Banner -->
<nav class="navbar">
    <div class="brand">
        <div>Rangishuri</div>
        <div class="banner-text">Welcome to Rangishuri - Your trusted partner for school concerns.</div>
    </div>
    <div class="auth-links">
        <a href="/">Register</a>
        <a href="/">Login</a>
    </div>
</nav>

<!-- Region Dropdowns Section -->
<div class="region-links">
    @foreach ($provinces as $province)
        <div class="dropdown">
            <button class="dropbtn">{{ $province->province }}</button>
            <div class="dropdown-menu">
                @foreach ($schoolsBySector[$province->province] ?? [] as $district => $sectors)
                    <div class="district">
                        <a href="#" class="district-link">{{ $district }}</a>
                        <div class="district-sectors" style="display: none;">
                            @foreach ($sectors as $sector => $schools)
                                <div class="sector">
                                    <a href="#" class="sector-link" data-sector="{{ $sector }}">{{ $sector }}</a>
                                    <div class="school-list" style="display: none;">
                                        @foreach ($schools as $school)
                                            <a href="{{ route('school.show', $school->id) }}" class="school-link">
                                                {{ $school->school_name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>





<script>
function toggleSectors(event, districtId) {
    event.preventDefault();
    let sectorsDiv = document.getElementById("sectors-" + districtId);
    if (sectorsDiv) {
        sectorsDiv.style.display = (sectorsDiv.style.display === "none") ? "block" : "none";
    }
}

function toggleSchools(event, sectorId) {
    event.preventDefault();
    let schoolsDiv = document.getElementById("schools-" + sectorId);
    if (schoolsDiv) {
        schoolsDiv.style.display = (schoolsDiv.style.display === "none") ? "block" : "none";
    }
}
</script>


<script>
$(document).ready(function () {
    // Toggle Districts
    $(".district-link").click(function (e) {
        e.preventDefault();
        $(this).next(".district-sectors").slideToggle();
    });

    // Toggle Schools when clicking a sector
    $(".sector-link").click(function (e) {
        e.preventDefault();
        $(this).next(".school-list").slideToggle();
    });
});



</script>
</body>
</html>
