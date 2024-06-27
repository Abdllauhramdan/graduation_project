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

    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div  class="categories__item categories__large__item set-bg photo1" >
                    <div class="categories__text" >
                        <h1>Cardiovascular Medications</h1>
                        <p style=" font-weight: 500;">We at Medico Pharmacy provide all services in all sections, Cardiovascular Medications ,Antihypertensives, Antidiabetic Medications, Antibiotics. We have everything you need.</p>
                        <a href="#">order now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg photo2" >
                            <div class="categories__text" >
                                <h4 >Hormonal Medications</h4>
                                <p >Division 101</p>
                                <a href="#">order now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg photo3" >
                            <div class="categories__text">
                                <h4>Antihypertensives</h4>
                                <p > Division 273 </p>
                            <a href="#">order now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg photo4" >
                            <div class="categories__text" >
                                <h4 > Antibiotics</h4>
                                <p > Division 159 </p>
                                <a href="#">order now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg photo5">
                            <div class="categories__text" >
                                <h4 > Vitamins and Supplements</h4>
                                <p>Division 792 </p>
                                <a href="#">order now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="site-section">
    <div class="container">
        <div class="row align-items-stretch section-overlap">
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="banner-wrap bg-primary h-100">
                    <a href="#" class="h-100">
                        <h5>Healthcare <br> Solutions</h5>
                        <p>
                            Explore our range of healthcare products
                            <strong>crafted for your well-being.</strong>
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="banner-wrap h-100">
                    <a href="#" class="h-100">
                        <h5>Wellness <br> Essentials</h5>
                        <p>
                            Discover essential products
                            <strong>to support your health.</strong>
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="banner-wrap bg-warning h-100">
                    <a href="#" class="h-100">
                        <h5>Expert <br> Consultation</h5>
                        <p>
                            Get expert advice and consultation
                            <strong>for your health needs.</strong>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section text-center col-12">
                <h2 class="text-uppercase">Popular Products</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <span class="tag">Sale</span>
                <a href="#"> <img src="{{ asset('images/product_01.png') }}" alt="Image"></a>
                <h3 class="text-dark"><a href="#">Bioderma</a></h3>
                <p class="price"><del>95.00</del> &mdash; $55.00</p>
            </div>
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <a href="#"> <img src="{{ asset('images/product_02.png') }}" alt="Image"></a>
                <h3 class="text-dark"><a href="#">Chanca Piedra</a></h3>
                <p class="price">$70.00</p>
            </div>
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <a href="#"> <img src="{{ asset('images/product_03.png') }}" alt="Image"></a>
                <h3 class="text-dark"><a href="#">Umcka Cold Care</a></h3>
                <p class="price">$120.00</p>
            </div>

            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <a href="#"> <img src="{{ asset('images/product_04.png') }}" alt="Image"></a>
                <h3 class="text-dark"><a href="#">Cetyl Pure</a></h3>
                <p class="price"><del>45.00</del> &mdash; $20.00</p>
            </div>
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <a href="#"> <img src="{{ asset('images/product_05.png') }}" alt="Image"></a>
                <h3 class="text-dark"><a href="#">CLA Core</a></h3>
                <p class="price">$38.00</p>
            </div>
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <span class="tag">Sale</span>
                <a href="#"> <img src="{{ asset('images/product_06.png') }}" alt="Image"></a>
                <h3 class="text-dark"><a href="#">Poo Pourri</a></h3>
                <p class="price"><del>$89</del> &mdash; $38.00</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="#" class="btn btn-primary px-4 py-3">View All Products</a>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="title-section text-center col-12">
                <h2 class="text-uppercase">New Products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 block-3 products-wrap">
                <div class="nonloop-block-3 owl-carousel">

                    <div class="text-center item mb-4">
                        <a href="#"> <img src="{{ asset('images/product_03.png') }}" alt="Image"></a>
                        <h3 class="text-dark"><a href="#">Umcka Cold Care</a></h3>
                        <p class="price">$120.00</p>
                    </div>

                    <div class="text-center item mb-4">
                        <a href="#"> <img src="{{ asset('images/product_01.png') }}" alt="Image"></a>
                        <h3 class="text-dark"><a href="#">Umcka Cold Care</a></h3>
                        <p class="price">$120.00</p>
                    </div>

                    <div class="text-center item mb-4">
                        <a href="#"> <img src="{{ asset('images/product_02.png') }}" alt="Image"></a>
                        <h3 class="text-dark"><a href="#">Umcka Cold Care</a></h3>
                        <p class="price">$120.00</p>
                    </div>

                    <div class="text-center item mb-4">
                        <a href="#"> <img src="{{ asset('images/product_04.png') }}" alt="Image"></a>
                        <h3 class="text-dark"><a href="#">Umcka Cold Care</a></h3>
                        <p class="price">$120.00</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section text-center col-12">
                <h2 class="text-uppercase">Testimonials</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 block-3 products-wrap">
                <div class="nonloop-block-3 no-direction owl-carousel">

                    <div class="testimony">
                        <blockquote>
                            <img src="{{ asset('images/person_1.jpg') }}" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                            <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat unde.&rdquo;</p>
                        </blockquote>
                        <p>&mdash; Kelly Holmes</p>
                    </div>

                    <div class="testimony">
                        <blockquote>
                            <img src="{{ asset('images/person_2.jpg') }}" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                            <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat unde.&rdquo;</p>
                        </blockquote>
                        <p>&mdash; Rebecca Morando</p>
                    </div>

                    <div class="testimony">
                        <blockquote>
                            <img src="{{ asset('images/person_3.jpg') }}" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                            <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat unde.&rdquo;</p>
                        </blockquote>
                        <p>&mdash; Lucas Gallone</p>
                    </div>

                    <div class="testimony">
                        <blockquote>
                            <img src="{{ asset('images/person_4.jpg') }}" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                            <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat unde.&rdquo;</p>
                        </blockquote>
                        <p>&mdash; Andrew Neel</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-secondary bg-image" style="background-image: url('{{ asset('images/bg_2.jpg') }}');">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('{{ asset('images/bg_1.jpg') }}');">
                    <div class="banner-1-inner align-self-center">
                        <h2>Pharma Products</h2>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0">
                <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('{{ asset('images/bg_2.jpg') }}');">
                    <div class="banner-1-inner ml-auto  align-self-center">
                        <h2>Rated by Experts</h2>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="(https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>

</html>
@endsection
