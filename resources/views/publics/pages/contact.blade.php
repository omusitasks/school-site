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
                <h1 class="display-4 text-white animated zoomIn">Contact Us</h1>
                <a href="{{ route('welcome.index') }}" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="{{ route('public.blogs.index') }}" class="h5 text-white">Contact</a>
            </div>
        </div>
    </div>
</div>
<!-- Navbar End -->




<!-- Contact Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
            <h1 class="mb-0">If You Have Any Query, Feel Free To Contact Us</h1>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                    <!-- For contact information -->
                    @if($contact_info)
                        @foreach ($contact_info as $info)
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="{{ $info->phone_icon }} text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Call to ask any question</h5>
                        <h4 class="text-primary mb-0">{{ $info->company_phone_number }}</h4>
                    </div>
                        @endforeach
                    @else
                        <p>No contact information available</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                    <!-- For email information -->
                    @if($email_info)
                        @foreach ($email_info as $info)
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="{{ $info->email_icon }} text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Email to get free quote</h5>
                        <h4 class="text-primary mb-0">{{ $info->company_email }}</h4>
                    </div>
                        @endforeach
                    @else
                        <p>No address information available</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
            <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                <!-- For address information -->
                @if($address_info)
                    @foreach ($address_info as $info)
                <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="{{ $info->address_icon }} text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Visit our office</h5>
                            <h4 class="text-primary mb-0">{{ $info->street_address_name }}, {{ $info->city }}</h4>
                        </div>
                    @endforeach
                @else
                    <p>No address information available</p>
                @endif
                </div>

            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-12 wow slideInUp" data-wow-delay="0.3s">
                <form action="{{ route('public.contact.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control border-0 bg-light px-4" id="exampleInputText"placeholder="Your Name" name="name" style="height: 55px;">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control border-0 bg-light px-4" id="exampleInputText" placeholder="Your Email" name="email" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control border-0 bg-light px-4" id="exampleInputText"  placeholder="Subject" name="subject" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control border-0 bg-light px-4 py-3" rows="4" id="exampleInputText"  placeholder="Message" name="message"></textarea>
                        </div>
                        
                        <div class="col-12">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div> -->
        </div>
    </div>
</div>
<!-- Contact End -->

{{-- footer --}}
  @include('publics.pages.footer')
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>
    {{-- js --}}
  @include('publics.layouts.js-1')
</body>

</html>




