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
            background-color: #002C5C;
            /* Dark blue */
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

        .auth-search-container {
            display: flex;
            align-items: center;
            gap: 0px;
            /* Keep elements close together */
        }


        /* Search Button Styling */
        .search-button-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-button-container button {
            background-color: #AEDFF7;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            color: #1B3A57;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .search-button-container button:hover {
            background-color: #1B3A57;
            color: white;
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

        /* Search Form Hidden by Default */
        .search-container {
            display: none;
            /* Initially hidden */
            margin: 20px auto;
            max-width: 900px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="brand">
            <a href="/" class="brand-link">
                <img src="{{ asset('global_assets/Logo.png') }}" alt="Rangishuri Logo" class="brand-logo"
                    style="width: 150px; height: auto;">
            </a>
            <div class="banner-text">Welcome to School-Connect - Your trusted partner for school concerns.</div>
        </div>

        <!-- Group Login, Register, and Search Together -->
        <div class="auth-search-container">
            <div class="auth-links">
                <a href="/">Register</a>
                <a href="{{ route('auth.login') }}">Login</a>
            </div>
            <div class="search-button-container">
                <button id="searchButton" class="btn btn-primary">Search Schools</button>
            </div>
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
                                        <a href="#" class="sector-link"
                                            data-sector="{{ $sector }}">{{ $sector }}</a>
                                        <div class="school-list" style="display: none;">
                                            @foreach ($schools as $school)
                                                <a href="{{ route('school.show', $school->school_code) }}" class="school-link">
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

    <!-- Search Form -->
    <div class="search-container">
        <h3 style="text-align: center; color: #1B3A57; margin-bottom: 20px;">Search Schools</h3>
        <form id="searchForm" action="{{ route('schools.filter') }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="province">Province</label>
                        <select class="form-control" id="province" name="province">
                            <option value="">Select Province</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->province }}">{{ $province->province }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="district">District</label>
                        <select class="form-control" id="district" name="district">
                            <option value="">Select District</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sector">Sector</label>
                        <select class="form-control" id="sector" name="sector">
                            <option value="">Select Sector</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="level_status">Level Status</label>
                        <select class="form-control" id="level_status" name="level_status">
                            <option value="">Select Level</option>
                            <option value="O-LEVEL">O-LEVEL</option>
                            <option value="A-LEVEL">A-LEVEL</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="combination">Combination</label>
                        <input type="text" class="form-control" id="combination" name="combination"
                            placeholder="MCB, MCE, MBC, ..." />
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Toggle Districts
            $(".district-link").click(function(e) {
                e.preventDefault();
                $(this).next(".district-sectors").slideToggle();
            });

            // Toggle Schools when clicking a sector
            $(".sector-link").click(function(e) {
                e.preventDefault();
                $(this).next(".school-list").slideToggle();
            });

            // Show/Hide search form
            $('#searchButton').click(function() {
                $('.search-container').slideToggle();
            });

            // Populate districts based on selected province
            $('#province').change(function() {
                let province = $(this).val();
                $('#district').html('<option value="">Select District</option>');
                $('#sector').html('<option value="">Select Sector</option>');

                if (province) {
                    $.ajax({
                        url: "{{ route('get.districts') }}",
                        type: "GET",
                        data: {
                            province: province
                        },
                        success: function(response) {
                            if (response.districts.length > 0) {
                                $.each(response.districts, function(key, district) {
                                    $('#district').append('<option value="' + district +
                                        '">' + district + '</option>');
                                });
                            }
                        }
                    });
                }
            });

            // Populate sectors based on selected district
            $('#district').change(function() {
                let district = $(this).val();
                $('#sector').html('<option value="">Select Sector</option>');

                if (district) {
                    $.ajax({
                        url: "{{ route('get.sectors') }}",
                        type: "GET",
                        data: {
                            district: district
                        },
                        success: function(response) {
                            if (response.sectors.length > 0) {
                                $.each(response.sectors, function(key, sector) {
                                    $('#sector').append('<option value="' + sector +
                                        '">' + sector + '</option>');
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>


</body>

</html>
