<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <title>The Buffalo Academy | Best Learning Platform</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
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
                    <h1 class="display-4 text-white animated zoomIn">Buffalo Academy AI</h1>
                    <a href="{{ route('welcome.index') }}" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ route('public.ai.index') }}" class="h5 text-white">Prices</a>
                </div>
            </div>
        </div>
</div>
<!-- Navbar End -->




<!-- Pricing Plan Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Pricing Plans</h5>
            <h1 class="mb-0">We are Offering Competitive Prices for Our Clients</h1>
        </div>
        <div class="row g-0">
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                <div class="bg-light rounded">
                    <div class="border-bottom py-4 px-5 mb-4">
                        <h4 class="text-primary mb-1">Basic Plan</h4>
                        <small class="text-uppercase">For One Person</small>
                    </div>
                    <div class="p-5 pt-0">
                        <h1 class="display-5 mb-3">
                            <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>49.00<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                        </h1>
                        <div class="d-flex justify-content-between mb-3"><span>Analytical Chemistry</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>Data Analysis</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>Web Development</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-2"><span>Technical Blogs</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <a href="{{ url('/ai') }}" class="btn btn-primary py-2 px-4 mt-4">Subscribe Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <div class="bg-white rounded shadow position-relative" style="z-index: 1;">
                    <div class="border-bottom py-4 px-5 mb-4">
                        <h4 class="text-primary mb-1">Standard Plan</h4>
                        <small class="text-uppercase">For 5-10 People</small>
                    </div>
                    <div class="p-5 pt-0">
                        <h1 class="display-5 mb-3">
                            <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>99.00<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                        </h1>
                        <div class="d-flex justify-content-between mb-3"><span>Analytical Chemistry</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>Data Analysis</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>Web Development</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-2"><span>Technical Blogs</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <a href="{{ url('/ai') }}" class="btn btn-primary py-2 px-4 mt-4">Subscribe Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="bg-light rounded">
                    <div class="border-bottom py-4 px-5 mb-4">
                        <h4 class="text-primary mb-1">Advanced Plan</h4>
                        <small class="text-uppercase">For more than 10 people</small>
                    </div>
                    <div class="p-5 pt-0">
                        <h1 class="display-5 mb-3">
                            <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>149.00<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                        </h1>
                        <div class="d-flex justify-content-between mb-3"><span>Analytical Chemistry</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>Data Analysis</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-3"><span>Web Development</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <div class="d-flex justify-content-between mb-2"><span>Technical Blogs</span><i class="fa fa-check text-primary pt-1"></i></div>
                        <a href="{{ url('/ai') }}" class="btn btn-primary py-2 px-4 mt-4">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pricing Plan End -->

    
    {{-- footer --}}
  @include('publics.pages.footer')
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>
    {{-- js --}}
  @include('publics.layouts.js-1')
</body>

</html>



