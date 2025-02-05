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

                <form action="#" method="post">

                <div class="p-3 p-lg-5 border">
                    <div class="form-group row">
                        <div class="col-md-6">
                        <label for="c_fname" class="text-black">find<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_fname" name="c_fname">
                    </div>
                    <div class="col-md-6">
                        <label for="c_fname" class="text-black">medicine name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="med_fname" name="c_fname">
                    </div>
                    <div class="col-md-6">
                        <label for="c_fname" class="text-black">Quantity <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ph_fname" name="ph_fname">
                    </div>
                    <div class="col-md-6">
                        <label for="c_lname" class="text-black">Company_name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_lname" name="c_lname">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_email" class="text-black">category_name <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="c_email" name="c_email" placeholder="">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black">price </label>
                        <input type="text" class="form-control" id="c_subject" name="c_subject">
                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black">descripation1</label>
                        <input type="text" class="form-control" id="c_password" name="c_password">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black"> Contraindications for use </label>
                        <input type="text" class="form-control" id="c_rpassword" name="c_rpassword">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black"> doseg</label>
                        <input type="text" class="form-control" id="c_adress" name="c_adress">
                    </div>
                    </div>
                        <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black"> med_shape </label>
                        <input type="text" class="form-control" id="N_adress" name="N_adress">
                    </div>
                    </div>
                        <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black">max_quantity </label>
                        <input type="text" class="form-control" id="med_adress" name="med_adress">
                    </div>
                    </div>

    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
    <div class="bootstrap-iso">
    <div class="container-fluid">
    <div class="row"><div class="form-group row">
    <div class="col-md-12">
        <form class="form-horizontal" method="post">
        <div class="form-group "> <div class="form-group row">
        <label class="control-label  col-md-12 requiredField text-black" for="date">
        Start_Date

            </label>
        <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-addon">
            <i class="fa fa-calendar">
            </i>
            </div>
            <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
        </div>
        </div>
        </div>
        </div>
        </form>
        </div></div>
    </div>
    </div>
    </div>
                    <div class="bootstrap-iso">
    <div class="container-fluid">
    <div class="row"><div class="form-group row">
    <div class="col-md-12">
        <form class="form-horizontal" method="post">
        <div class="form-group "> <div class="form-group row">
        <label class="control-label  col-md-12 requiredField text-black" for="date">
            End_Date

            </label>
        <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-addon">
            <i class="fa fa-calendar">
            </i>
            </div>
            <input class="form-control" id=" end_date" name="date" placeholder="MM/DD/YYYY" type="text"/>
        </div>
        </div>
        </div>
        </div>
        </form>
        </div></div>
    </div>
    </div>
    </div>


        <!--end radio box -->

                    <!-- <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_message" class="text-black">Message </label>
                        <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                    </div>
                    </div>-->
                    <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit">
                    </div>
                    </div>
                </div>
                </form>
            </div>

            </div>
        </div>
        </div>



        <div class="site-section bg-primary">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <h2 class="text-white mb-4">Offices</h2>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white mb-3 rounded">
                <span class="d-block text-black h6 text-uppercase">New York</span>
                <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white mb-3 rounded">
                <span class="d-block text-black h6 text-uppercase">London</span>
                <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white mb-3 rounded">
                <span class="d-block text-black h6 text-uppercase">Canada</span>
                <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>
            </div>
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

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/aos.js"></script>

    <script src="js/main.js"></script>
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

    <link rel="stylesheet" href="../css/style.css">

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

                <form action="#" method="post">

                <div class="p-3 p-lg-5 border">
                    <div class="form-group row">
                    <div class="col-md-6">
                        <label for="c_fname" class="text-black">medicine name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_fname" name="c_fname">
                    </div>
                    <div class="col-md-6">
                        <label for="c_fname" class="text-black">Quantity <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ph_fname" name="ph_fname">
                    </div>
                    <div class="col-md-6">
                        <label for="c_lname" class="text-black">Company_name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_lname" name="c_lname">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_email" class="text-black">category_name <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="c_email" name="c_email" placeholder="">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black">price </label>
                        <input type="text" class="form-control" id="c_subject" name="c_subject">
                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black">descripation1</label>
                        <input type="text" class="form-control" id="c_password" name="c_password">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black"> Contraindications for use </label>
                        <input type="text" class="form-control" id="c_rpassword" name="c_rpassword">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black"> doseg</label>
                        <input type="text" class="form-control" id="c_adress" name="c_adress">
                    </div>
                    </div>
                        <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black"> med_shape </label>
                        <input type="text" class="form-control" id="N_adress" name="N_adress">
                    </div>
                    </div>
                        <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black">max_quantity </label>
                        <input type="text" class="form-control" id="med_adress" name="med_adress">
                    </div>
                    </div>

    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
    <div class="bootstrap-iso">
    <div class="container-fluid">
    <div class="row"><div class="form-group row">
    <div class="col-md-12">
        <form class="form-horizontal" method="post">
        <div class="form-group "> <div class="form-group row">
        <label class="control-label  col-md-12 requiredField text-black" for="date">
        Start_Date

            </label>
        <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-addon">
            <i class="fa fa-calendar">
            </i>
            </div>
            <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
        </div>
        </div>
        </div>
        </div>
        </form>
        </div></div>
    </div>
    </div>
    </div>
                    <div class="bootstrap-iso">
    <div class="container-fluid">
    <div class="row"><div class="form-group row">
    <div class="col-md-12">
        <form class="form-horizontal" method="post">
        <div class="form-group "> <div class="form-group row">
        <label class="control-label  col-md-12 requiredField text-black" for="date">
            End_Date

            </label>
        <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-addon">
            <i class="fa fa-calendar">
            </i>
            </div>
            <input class="form-control" id=" end_date" name="date" placeholder="MM/DD/YYYY" type="text"/>
        </div>
        </div>
        </div>
        </div>
        </form>
        </div></div>
    </div>
    </div>
    </div>


        <!--end radio box -->

                    <!-- <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_message" class="text-black">Message </label>
                        <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                    </div>
                    </div>-->
                    <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit">
                    </div>
                    </div>
                </div>
                </form>
            </div>

            </div>
        </div>
        </div>



        <div class="site-section bg-primary">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <h2 class="text-white mb-4">Offices</h2>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white mb-3 rounded">
                <span class="d-block text-black h6 text-uppercase">New York</span>
                <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white mb-3 rounded">
                <span class="d-block text-black h6 text-uppercase">London</span>
                <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-white mb-3 rounded">
                <span class="d-block text-black h6 text-uppercase">Canada</span>
                <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>
            </div>
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
