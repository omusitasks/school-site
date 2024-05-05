<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <title>The Buffalo Academy | Best Learning Platform</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    {{-- css --}}
      @include('publics.layouts.css')
    </head>

    <body>

    <!-- Spinner Start -->
    {{-- spinner --}}
  @include('publics.pages.spinner')
    <!-- Spinner End -->


    <!-- Topbar Start -->
    {{-- topbar --}}
  @include('publics.pages.topbar')
    <!-- Topbar End -->


     

<!-- Navbar Start -->
<div class="container-fluid position-relative p-0">
    
<!-- Navbar start -->
{{-- navbar --}}
  @include('publics.pages.navbar')

    <!-- Navbar end -->

    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">About Us</h1>
                <a href="{{ route('welcome.index') }}" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="{{ route('public.about.index') }}" class="h5 text-white">About</a>
            </div>
        </div>
    </div>
</div>
<!-- Navbar End -->




<!-- Service Start -->
<div class="container-xxl py-5">
<div class="container">
    <div class="row g-4">
        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item text-center pt-3">
                <div class="p-4">
                    <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                    <h5 class="mb-3">Skilled Instructors</h5>
                    <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item text-center pt-3">
                <div class="p-4">
                    <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                    <h5 class="mb-3">Online Tutorials</h5>
                    <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item text-center pt-3">
                <div class="p-4">
                    <i class="fa fa-3x fa-home text-primary mb-4"></i>
                    <h5 class="mb-3">Home Projects</h5>
                    <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
            <div class="service-item text-center pt-3">
                <div class="p-4">
                    <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                    <h5 class="mb-3">Realiable Materials</h5>
                    <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Service End -->


<!-- About Start -->
<div class="container-xxl py-5">
<div class="container">
    <div class="row g-5">
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
            <div class="position-relative h-100">
                <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('backend/assets-2') }}/img/about.jpg" alt="" style="object-fit: cover;">
            </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
            <h6 class="about-title bg-white text-start text-primary pe-3">About Us</h6>
            <h1 class="mb-4">Welcome to The Buffalo Academy</h1>
            <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
            <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
            <div class="row gy-2 gx-4 mb-4">
                <div class="col-sm-6">
                    <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                </div>
                <div class="col-sm-6">
                    <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                </div>
                <div class="col-sm-6">
                    <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                </div>
                <div class="col-sm-6">
                    <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                </div>
                <div class="col-sm-6">
                    <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                </div>
                <div class="col-sm-6">
                    <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                </div>
            </div>
            <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
        </div>
    </div>
</div>
</div>
<!-- About End -->


<!-- Team Start -->
<div class="container-xxl py-5">
<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h6 class="about-title bg-white text-center text-primary px-3">Instructors</h6>
        <h1 class="mb-5">Expert Instructors</h1>
    </div>
    <div class="row g-4">
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="team-item bg-light">
                <div class="overflow-hidden">
                    <img class="img-fluid" src="{{ asset('backend/assets-2') }}/img/team-1.jpg" alt="">
                </div>
                <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                    <div class="bg-light d-flex justify-content-center pt-2 px-1">
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="text-center p-4">
                    <h5 class="mb-0">Instructor Name</h5>
                    <small>Designation</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="team-item bg-light">
                <div class="overflow-hidden">
                    <img class="img-fluid" src="{{ asset('backend/assets-2') }}/img/team-2.jpg" alt="">
                </div>
                <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                    <div class="bg-light d-flex justify-content-center pt-2 px-1">
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="text-center p-4">
                    <h5 class="mb-0">Instructor Name</h5>
                    <small>Designation</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="team-item bg-light">
                <div class="overflow-hidden">
                    <img class="img-fluid" src="{{ asset('backend/assets-2') }}/img/team-3.jpg" alt="">
                </div>
                <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                    <div class="bg-light d-flex justify-content-center pt-2 px-1">
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="text-center p-4">
                    <h5 class="mb-0">Instructor Name</h5>
                    <small>Designation</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
            <div class="team-item bg-light">
                <div class="overflow-hidden">
                    <img class="img-fluid" src="{{ asset('backend/assets-2') }}/img/team-4.jpg" alt="">
                </div>
                <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                    <div class="bg-light d-flex justify-content-center pt-2 px-1">
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="text-center p-4">
                    <h5 class="mb-0">Instructor Name</h5>
                    <small>Designation</small>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Team End -->





    {{-- footer --}}
  @include('publics.pages.footer')
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>
    {{-- js --}}
  @include('publics.layouts.js-1')
</body>

</html>



