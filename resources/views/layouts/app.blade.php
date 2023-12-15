<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/logo1.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    {{-- trix editor --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">

    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-button').on('click', function(e) {
                e.preventDefault();

                var form = $(this).closest('.delete-form');

                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function() {
                        // Remove the notification container from the DOM
                        form.closest('.message-body').remove();

                        // Optionally, you can display a success message
                        alert('Notification deleted successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting notification:', error);
                    }
                });
            });
        });
    </script>

    <style>
        .delete-button:hover {
            /* Add your hover styles here */
            color: red;
            /* For example, change text color to red on hover */
            /* Add any other styles or animations you want */
        }
    </style>

    <style>
        /* Add this style in your head or in your CSS file */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 20%;
            top: 10%;
            width: 60%;
            overflow: auto;
            animation: fadeIn 0.5s;
        }

        .modal-content {
            position: relative;
            margin: auto;
            padding: 20px;
            background-color: #5D87FF;
            /* Set the theme color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: scaleIn 0.5s;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            /* Increase the font size for a bigger close button */
            font-weight: bold;
            color: #fff;
            /* Set the close button color to white */
            cursor: pointer;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
            }

            to {
                transform: scale(1);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
    <style>
        /* Style the dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Style the button inside the dropdown */
        .dropdown-button {
            background-color: #5D87FF;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 10px;
        }

        /* Style the dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Style the dropdown links */
        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown content when the dropdown button is clicked */
        .show {
            display: block;
        }

        /* Add this to your existing CSS styles */
        .popover {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            display: none;
        }
    </style>
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}

    <!-- Bootstrap JS Bundle (Bootstrap + Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @livewireStyles
</head>

<body>
    @livewireScripts
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            @include('partials.sidebar')
            <!--  Main wrapper -->
            <div class="body-wrapper">
                @include('partials.nav')
                <div class="container-fluid">
                    @yield('main')
                </div>
            </div>
    </div>
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        // function onScanSuccess(decodedText, decodedResult) {
        //     // handle the scanned code as you like, for example:
        //     // console.log(`Code matched = ${decodedText}`, decodedResult);
        //     // $("#result").val(decodedText)
        //     window.location.href = decodedText;
        // }
        function onScanSuccess(decodedText, decodedResult) {
            // Assuming decodedText contains a URL
            if (decodedText && decodedText.startsWith('http')) {
                // Redirect to the URL from the QR code
                window.location.href = decodedText;
            } else {
                // Handle the scanned code as needed
                console.log(`Code matched = ${decodedText}`, decodedResult);
            }
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
    <script>
        // Function to toggle the dropdown content visibility
        function toggleDropdown() {
            var dropdown = document.getElementById("myDropdown");
            dropdown.classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-button')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    <!-- Add this in your HTML file, make sure to include it before your script -->
</body>

</html>
