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
                    <h1 class="display-4 text-white animated zoomIn">Services</h1>
                    <a href="{{ url('/') }}" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ url('/services') }}" class="h5 text-white">Services</a>
                </div>
            </div>
        </div>
</div>
<!-- Navbar End -->



 <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Our Services</h5>
                <h1 class="mb-0">Custom Learning Platform</h1>
            </div>
            <div class="row g-5">
            <!-- For system services information -->
            @if($services)
                @foreach ($services as $services)
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="{{ $services-> service_icon }} text-white"></i>
                        </div>
                        <h4 class="mb-3">{{ $services-> name }}</h4>
                        <p class="m-0">{{ $services-> description }}</p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>  
                </div>
                @endforeach
            @else
                <p>No system services information available</p>
            @endif
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <h3 class="text-white mb-3">Call Us For Quote</h3>
                        <p class="text-white mb-3">We provide the tools and skills to teach what you love.</p>
                        <h2 class="text-white mb-0">+254 112 937557</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Service End -->



    <!-- Testimonial Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Testimonial</h5>
                <h1 class="mb-0">What Our Clients Say About Our Services</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
            <!-- For students testimonials information -->
            @if($student_testimonials)
                @foreach ($student_testimonials as $student_testimonials)
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="{{ Storage::url($student_testimonials->student_image_path) }}" style="width: 60px; height: 60px;" >
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">{{ $student_testimonials-> student_name }}</h4>
                            <small class="text-uppercase">{{ $student_testimonials-> student_course }}</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                    {{ $student_testimonials-> testmonial_message }}
                    </div>
                </div>
                @endforeach
            @else
                <p>No students testimonials information available</p>
            @endif
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Partners Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5 mb-5">
            <div class="bg-white">
                <div class="owl-carousel vendor-carousel">
                    <!-- For partners information -->
            @if($partners)
                @foreach ($partners as $partners)
                    <img src="{{ Storage::url($partners->partner_logo_path) }}" alt="">
                @endforeach
            @else
                <p>Buffalo Academy has not partnered with any Company.</p>
            @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Partners End -->



{{-- footer --}}
  @include('publics.pages.footer')
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>
    {{-- js --}}
  @include('publics.layouts.js-1')
</body>

</html>




