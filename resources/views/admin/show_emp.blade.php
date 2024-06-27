    @extends('layouts.master')

            @section('content')
            <!DOCTYPE html>
            <html lang="en">

            <head>
            <title>Pharma &mdash; Colorlib Template</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

            <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
            <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
            <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
            <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

            <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

            <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <style>
        .btn-container {
                white-space: nowrap;
            }
            .btn-container .btn {
                margin-right: 5px;
            }</style>

    </head>

    <body>

    <div class="site-wrap">


        <div class="site-navbar py-2">

        <div class="search-wrap">
            <div class="container">
            <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
            <form action="#" method="post">
                <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
            </form>
            </div>
        </div>

        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
                <div class="site-logo">
                <a href="#" class="js-logo-clone">Pharma</a>
                </div>
            </div>
            <div class="main-nav d-none d-lg-block">
                <nav class="site-navigation text-right text-md-center" role="navigation">
                <ul class="site-menu js-clone-nav d-none d-lg-block">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Store</a></li>
                    <li class="has-children">
                    <a href="#">Dropdown</a>
                    <ul class="dropdown">
                        <li><a href="#">Supplements</a></li>
                        <li class="has-children">
                        <a href="#">Vitamins</a>
                        <ul class="dropdown">
                            <li><a href="#">Supplements</a></li>
                            <li><a href="#">Vitamins</a></li>
                            <li><a href="#">Diet &amp; Nutrition</a></li>
                            <li><a href="#">Tea &amp; Coffee</a></li>
                        </ul>
                        </li>
                        <li><a href="#">Diet &amp; Nutrition</a></li>
                        <li><a href="#">Tea &amp; Coffee</a></li>

                    </ul>
                    </li>
                    <li><a href="#">About</a></li>
                    <li class="active"><a href="#">Contact</a></li>
                </ul>
                </nav>
            </div>
            <div class="icons">
                <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                <a href="#" class="icons-btn d-inline-block bag">
                <span class="icon-shopping-bag"></span>
                <span class="number">2</span>
                </a>
                <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                    class="icon-menu"></span></a>
            </div>
            </div>
        </div>
        </div>

        <div class="bg-light py-3">
        <div class="container">
            <div class="row">
            <div class="col-md-12 mb-0">
                <a href="#">Home</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Contact</strong>
            </div>
            </div>
        </div>
        </div>

        <div class="site-section">
        <div class="container">
            <div class="row">
            <div class="col-md-12">
                <h2 class="h3 mb-5 text-black">Get In Touch</h2>
            </div>
            <div class="col-md-12">

    <!--
                <form action="#" method="post">

                <div class="p-3 p-lg-5 border">
                    <div class="form-group row">
                    <div class="col-md-6">
                        <label for="c_fname" class="text-black">category name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_fname" name="c_fname">
                    </div>

                    </div>
            </div>
    -->
        <h2 class="text-center mb-4">Employee Details</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>first_name</td>
                            <td>last_name</td>
                            <td>email</td>
                            <td>password</td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Additional Details:</strong></td>
                        </tr>
                        <tr>
                            <td>Birth Date:</td>
                            <td>Phone:</td>
                            <td>Address:</td>
                            <td>Gender:</td>
                        </tr>
                        <tr>
                            <td>Is Employee:</td>
                            <td>Job Title:</td>
                            <td>Salary:</td>
                            <td></td> <!-- Leave one cell empty to maintain alignment -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        </div>


        <footer class="site-footer">
        <div class="container">
            <div class="row">
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

                <div class="block-7">
                <h3 class="footer-heading mb-4">About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio voluptates
                    sed dolorum excepturi iure eaque, aut unde.</p>
                </div>

            </div>
            <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
                <h3 class="footer-heading mb-4">Quick Links</h3>
                <ul class="list-unstyled">
                <li><a href="#">Supplements</a></li>
                <li><a href="#">Vitamins</a></li>
                <li><a href="#">Diet &amp; Nutrition</a></li>
                <li><a href="#">Tea &amp; Coffee</a></li>
                </ul>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="block-5 mb-5">
                <h3 class="footer-heading mb-4">Contact Info</h3>
                <ul class="list-unstyled">
                    <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                    <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                    <li class="email">emailaddress@domain.com</li>
                </ul>
                </div>


            </div>
            </div>
            <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made
                with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank"
                    class="text-primary">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>

            </div>
        </div>
        </footer>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
                    <script src="{{ asset('js/jquery-ui.js') }}"></script>
                    <script src="{{ asset('js/popper.min.js') }}"></script>
                    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
                    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
                    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
                    <script src="{{ asset('js/aos.js') }}"></script>
                    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Extra JavaScript/CSS added manually in "Settings" tab -->
    <!-- Include jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <script>
        $(document).ready(function(){
            var date_input=$('input[name="date"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
    </script>
    </body>

    </html>
    @endsection
