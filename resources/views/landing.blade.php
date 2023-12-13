<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sensei Library</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logos/logo1.png') }}" />
</head>

<body id="body" data-spy="scroll" data-target=".navbar" data-offset="100">
    <header id="header-section">
        <nav class="navbar navbar-expand-lg pl-3 pl-sm-0" id="navbar">
            <div class="container">
                <div class="navbar-brand-wrapper d-flex w-100">
                    <img src="images/logos/logo-perpus.png" alt="">
                    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mdi mdi-menu navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-menu-wrapper" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-lg-center align-items-start ml-auto">
                        <li class="d-flex align-items-center justify-content-between pl-4 pl-lg-0">
                            <div class="navbar-collapse-logo">
                                <img src="images/logos/logo-perpus.png" alt="">
                            </div>
                            <button class="navbar-toggler close-button" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="mdi mdi-close navbar-toggler-icon pl-5"></span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#header-section">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features-section">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#digital-marketing-section">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#feedback-section">Testimonials</a>
                        </li>
                        <li class="nav-item btn-contact-us pl-4 pl-lg-0">
                            <button class="btn btn-info px-5 mr-3" onclick="location.href='/register'">Daftar</button>
                            <button class="btn btn-outline-info px-5" onclick="location.href='/login'">Masuk</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="banner">
        <div class="container">
            <h1 class="font-weight-semibold pb-1">Mulai dari membaca 😋</h1>
            <h6 class="font-weight-normal text-muted pb-3">Cari dan jelajahi berbagai macam buku hanya disini. Pinjam
                buku tanpa biaya</h6>
            <div>
                <button class="btn btn-opacity-light mr-1">Get started</button>
                <button class="btn btn-opacity-success ml-1">Learn more</button>
            </div>
            <img src="images/gojo1.png" alt="" class="img-fluid mt-5">
            <img src="images/toji2.png" alt="" class="img-fluid mt-5" style="margin-left: -200px">
            {{-- <div class="row align-items-center justify-content-center">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                </div>
            </div> --}}
        </div>
    </div>
    <div class="content-wrapper">
        <div class="container">
            <section class="features-overview" id="features-section">
                <div class="content-header">
                    <h2>Fitur Unggulan Kami</h2>
                    <h6 class="section-subtitle text-muted mt-3">Sensei Library memiliki beberapa fitur unggulan yang
                        dapat diandalkan untuk anda</h6>
                </div>
                <div class="d-md-flex justify-content-between">
                    <div class="grid-margin d-flex justify-content-start">
                        <div class="features-width">
                            <img src="images/scan.png" alt="" class="img-icons" height="50" width="50">
                            <h5 class="py-3">Scan<br>QR</h5>
                            <p class="text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum. Fusce egeabus
                                consectetuer turpis, suspendisse.</p>
                            <a href="#">
                                <p class="readmore-link">Readmore</p>
                            </a>
                        </div>
                    </div>
                    <div class="grid-margin d-flex justify-content-center">
                        <div class="features-width">
                            <img src="images/fine.png" alt="" class="img-icons" height="50"
                                width="50">
                            <h5 class="py-3">Denda<br>Online</h5>
                            <p class="text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum. Fusce egeabus
                                consectetuer turpis, suspendisse.</p>
                            <a href="#">
                                <p class="readmore-link">Readmore</p>
                            </a>
                        </div>
                    </div>
                    <div class="grid-margin d-flex justify-content-end">
                        <div class="features-width">
                            <img src="images/book-stack.png" alt="" class="img-icons" height="50"
                                width="50">
                            <h5 class="py-3">Pinjam<br>Online</h5>
                            <p class="text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum. Fusce egeabus
                                consectetuer turpis, suspendisse.</p>
                            <a href="#">
                                <p class="readmore-link">Readmore</p>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="digital-marketing-service" id="digital-marketing-section">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-7 grid-margin grid-margin-lg-0" data-aos="fade-right">
                        <h3 class="m-0">Kami Menyediakan layanan<br>Peminjaman Buku online yang praktis!</h3>
                        <div class="col-lg-7 col-xl-6 p-0">
                            <p class="py-4 m-0 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum. Fusce
                                egeabus consectetuer turpis, suspendisse.</p>
                            <p class="font-weight-medium text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                Fusce egeabus consectetuer</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 p-0 img-digital grid-margin grid-margin-lg-0" data-aos="fade-left">
                        <img src="images/Group1.png" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-12 col-lg-7 text-center flex-item grid-margin" data-aos="fade-right">
                        <img src="images/Group2.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-12 col-lg-5 flex-item grid-margin" data-aos="fade-left">
                        <h3 class="m-0">Cari dan jelajahi<br>berbagai macam genre buku yang kamu inginkan</h3>
                        <div class="col-lg-9 col-xl-8 p-0">
                            <p class="py-4 m-0 text-muted">Power-packed with impressive features and well-optimized,
                                this template is designed to provide the best performance in all circumstances.</p>
                            <p class="pb-2 font-weight-medium text-muted">Its smart features make it a powerful
                                stand-alone website building tool.</p>
                        </div>
                        <button class="btn btn-info">Readmore</button>
                    </div>
                </div>
            </section>
            <section class="case-studies" id="case-studies-section">
                <div class="row grid-margin">
                    <div class="col-12 text-center pb-5">
                        <h2>Kategori Unggulan</h2>
                        <h6 class="section-subtitle text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.</h6>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 stretch-card mb-3 mb-lg-0" data-aos="zoom-in">
                        <div class="card color-cards">
                            <div class="card-body p-0">
                                <div class="bg-primary text-center card-contents">
                                    <div class="card-image">
                                        <img src="images/manga.png" class="case-studies-card-img" alt="">
                                    </div>
                                    <div class="card-desc-box d-flex align-items-center justify-content-around">
                                        <div>
                                            <h6 class="text-white pb-2 px-3">Jelajahi Manga</h6>
                                            <button class="btn btn-white">Read More</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-details text-center pt-4">
                                    <h6 class="m-0 pb-1">Manga</h6>
                                    {{-- <p>Seo, Marketing</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 stretch-card mb-3 mb-lg-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="card color-cards">
                            <div class="card-body p-0">
                                <div class="bg-warning text-center card-contents">
                                    <div class="card-image">
                                        <img src="images/Agama.png" class="case-studies-card-img" alt="">
                                    </div>
                                    <div class="card-desc-box d-flex align-items-center justify-content-around">
                                        <div>
                                            <h6 class="text-white pb-2 px-3">Jelajahi Agama</h6>
                                            <button class="btn btn-white">Read More</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-details text-center pt-4">
                                    <h6 class="m-0 pb-1">Agama</h6>
                                    {{-- <p>Developing, Designing</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 stretch-card mb-3 mb-lg-0" data-aos="zoom-in"
                        data-aos-delay="400">
                        <div class="card color-cards">
                            <div class="card-body p-0">
                                <div class="bg-violet text-center card-contents">
                                    <div class="card-image">
                                        <img src="images/novel.png" class="case-studies-card-img" alt="">
                                    </div>
                                    <div class="card-desc-box d-flex align-items-center justify-content-around">
                                        <div>
                                            <h6 class="text-white pb-2 px-3">Jelajahi Novel</h6>
                                            <button class="btn btn-white">Read More</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-details text-center pt-4">
                                    <h6 class="m-0 pb-1">Novel</h6>
                                    {{-- <p>Designing, Developing</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 stretch-card" data-aos="zoom-in" data-aos-delay="600">
                        <div class="card color-cards">
                            <div class="card-body p-0">
                                <div class="bg-success text-center card-contents">
                                    <div class="card-image">
                                        <img src="images/science.png" class="case-studies-card-img" alt="">
                                    </div>
                                    <div class="card-desc-box d-flex align-items-center justify-content-around">
                                        <div>
                                            <h6 class="text-white pb-2 px-3">Jelajahi Science</h6>
                                            <button class="btn btn-white">Read More</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-details text-center pt-4">
                                    <h6 class="m-0 pb-1">Science</h6>
                                    {{-- <p>Developing, Designing</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- <section class="customer-feedback" id="feedback-section">
                <div class="row">
                    <div class="col-12 text-center pb-5">
                        <h2>Apa kata mereka ?</h2>
                        <h6 class="section-subtitle text-muted m-0">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                        </h6>
                    </div>
                    <div class="owl-carousel owl-theme grid-margin">
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/yohan.jpg" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Johan Seong</h6>
                                    <h6 class="customer-designation text-muted m-0">Pelajar</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/razor.jpg" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Razor</h6>
                                    <h6 class="customer-designation text-muted m-0">Pekerja Lepas</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/gojo.jpeg" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Gojo Satoru</h6>
                                    <h6 class="customer-designation text-muted m-0">Guru</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/hanjun.jpg" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Park Hanjun</h6>
                                    <h6 class="customer-designation text-muted m-0">Tukang Pukul</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/kazuha.jpg" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Kaedara Kazuha</h6>
                                    <h6 class="customer-designation text-muted m-0">Pelajar</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/thoma.jpg" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Thoma</h6>
                                    <h6 class="customer-designation text-muted m-0">ART</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/wrio.jpg" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Wriothesley</h6>
                                    <h6 class="customer-designation text-muted m-0">Pekerja</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/ron.jpg" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Ron Komonohasi</h6>
                                    <h6 class="customer-designation text-muted m-0">Detektif</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-cards">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="images/toge.jfif" width="89" height="89" alt=""
                                        class="img-customer">
                                    <p class="m-0 py-3 text-muted">Lorem ipsum dolor sit amet, tincidunt vestibulum.
                                        Fusce egeabus consectetuer turpis, suspendisse.</p>
                                    <div class="content-divider m-auto"></div>
                                    <h6 class="card-title pt-3">Inumaki Toge</h6>
                                    <h6 class="customer-designation text-muted m-0">Pelajar</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
            <section class="contact-us" id="contact-section">
                <div class="contact-us-bgimage grid-margin">
                    <div class="pb-4">
                        <h4 class="px-3 px-md-0 m-0" data-aos="fade-down">Masih kurang yakin?</h4>
                        {{-- <h4 class="pt-1" data-aos="fade-down">Masuk</h4> --}}
                    </div>
                    <div data-aos="fade-up">
                        <button class="btn btn-rounded btn-outline-danger">Coba Sekarang</button>
                    </div>
                </div>
            </section>
            <section class="contact-details" id="contact-details-section">
                <div class="row text-center text-md-left">
                    <div class="col-12 col-md-6 col-lg-3 grid-margin">
                        <img src="images/logos/logo-perpus.png" alt="" class="pb-2">
                        <div class="pt-2">
                            <p class="text-muted m-0">gojo@gmail.com</p>
                            <p class="text-muted m-0">906-179-8309</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 grid-margin">
                        <h5 class="pb-2">Get in Touch</h5>
                        <p class="text-muted">Beri masukan untuk website kami!</p>
                        <form>
                            <input type="text" class="form-control" id="Email" placeholder="alamat email">
                        </form>
                        <div class="pt-3">
                            <button class="btn btn-dark">Kirim</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 grid-margin">
                        <h5 class="pb-2">Syarat dan Ketentuan</h5>
                        <a href="#">
                            <p class="m-0 pb-2">Terms</p>
                        </a>
                        <a href="#">
                            <p class="m-0 pt-1 pb-2">Privacy policy</p>
                        </a>
                        <a href="#">
                            <p class="m-0 pt-1 pb-2">Cookie Policy</p>
                        </a>
                        <a href="#">
                            <p class="m-0 pt-1">Discover</p>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 grid-margin">
                        <h5 class="pb-2">Alamat Kami</h5>
                        <p class="text-muted">518 Schmeler Neck<br>Bartlett. Illinois</p>
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <a href="#"><span class="mdi mdi-facebook"></span></a>
                            <a href="#"><span class="mdi mdi-twitter"></span></a>
                            <a href="#"><span class="mdi mdi-instagram"></span></a>
                            <a href="#"><span class="mdi mdi-linkedin"></span></a>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="border-top">
                <p class="text-center text-muted pt-4">Copyright © 2023<a href="https://www.bootstrapdash.com/"
                        class="px-1">Sensei Library.</a>All rights reserved.</p>

                {{-- <p class="text-center text-muted pt-2">Distributed By: <a href="https://www.themewagon.com/"
                        class="px-1" target="_blank">Themewagon</a></p> --}}
            </footer>
            <!-- Modal for Contact - us Button -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Masuk</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control" id="Name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" id="Email-1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="Message">Message</label>
                                    <textarea class="form-control" id="Message" placeholder="Enter your Message"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendors/aos/js/aos.js') }}"></script>
    <script src="{{ asset('js/landingpage.js') }}"></script>
</body>

</html>
