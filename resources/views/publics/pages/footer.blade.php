<!-- Footer Start -->
<div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-4 col-md-6 footer-about">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                    <a href="{{ route('welcome.index') }}" class="navbar-brand">
                        <h1 class="m-0 text-white"><i class="fa fa-user-tie me-2"></i>The Buffalo</h1><br>
                        <h1 class="m-0 text-white">Academy</h1>
                    </a>
                    <p class="mt-3 mb-4">The Best Online Learning Platform.</p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                            <button class="btn btn-dark">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <div class="footer-title footer-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Get In Touch</h3>
                        </div>
                        <div class="d-flex mb-2">
                            <!-- For address information -->
                            @if($address_info)
                                @foreach ($address_info as $address_info)
                                <i class="{{ $address_info-> address_icon }} text-primary me-2"></i>
                                <p class="mb-0">{{ $address_info-> street_address_name }}, {{ $address_info-> city }}, {{ $address_info-> country }}</p>
                                @endforeach
                            @else
                                <p>No address information available</p>
                            @endif
                        </div>
                        <div class="d-flex mb-2">
                            <!-- For email information -->
                            @if($email_info)
                                @foreach ($email_info as $email_info)
                                <i class="{{ $email_info->email_icon }} text-primary me-2"></i>
                                <p class="mb-0">{{ $email_info->company_email }}</p>
                                @endforeach
                            @else
                                <p>No email information available</p>
                            @endif
                        </div>
                        <div class="d-flex mb-2">
                            <!-- For contact information -->
                            @if($contact_info)
                                @foreach ($contact_info as $contact_info)
                                <i class="{{ $contact_info->phone_icon }} text-primary me-2"></i>
                                <p class="mb-0">{{ $contact_info->company_phone_number }}</p>
                                @endforeach
                            @else
                                <p>No contact information available</p>
                            @endif
                        </div>
                        <div class="d-flex mt-4">
                            @foreach ($footer as $footer)
                                <a class="btn btn-primary btn-square me-2" href="{{ $footer->link }}"><i class="{{ $footer->footer_media_icon }} fw-normal"></i></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <div class="footer-title footer-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Quick Links</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="{{ route('welcome.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-light mb-2" href="{{ route('public.about.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-light mb-2" href="{{ route('public.services.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                            <a class="text-light mb-2" href="{{ route('public.about.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The Instructors</a>
                            <a class="text-light mb-2" href="{{ route('public.blogs.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-light" href="{{ route('public.contact.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <div class="footer-title footer-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Popular Links</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="{{ route('welcome.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-light mb-2" href="{{ route('public.about.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-light mb-2" href="{{ route('public.services.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                            <a class="text-light mb-2" href="{{ route('public.about.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The Instructors</a>
                            <a class="text-light mb-2" href="{{ route('public.blogs.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-light" href="{{ route('public.contact.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid text-white" style="background: #061429;">
    <div class="container text-center">
        <div class="row justify-content-end">
            <div class="col-lg-8 col-md-6">
                <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                    <p class="mb-0">&copy; <a class="text-white border-bottom" href="https://thebuffaloacademy.com">The Buffalo Academy</a>. All Rights Reserved. 
                    
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    <!-- Designed by <a class="text-white border-bottom" href="https://thebuffaloacademy.com">The Buffalo Software Team</a></p> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
