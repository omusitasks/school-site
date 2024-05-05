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
                    <h1 class="display-4 text-white animated zoomIn">Blog</h1>
                    <a href="{{ route('welcome.index') }}" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ route('public.blogs.show', $blog->id) }}" class="h5 text-white">Blog Detail View</a>
                </div>
            </div>
        </div>
</div>
<!-- Navbar End -->


<!-- Blog Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="mb-5">
                        <img class="img-fluid w-100 rounded mb-5" src="{{ Storage::url($blog->blog_image_path) }}" alt="">
                        <h1 class="mb-4">{{ $blog->name }}</h1>
                        @php
                        // Split the description into words
                        $words = explode(' ', $blog->description);
                        // Initialize an empty array to store paragraphs
                        $paragraphs = [];
                        // Loop through words and group them into paragraphs of approximately 72 words each
                        $currentParagraph = '';
                        foreach ($words as $word) {
                            $currentParagraph .= $word . ' ';
                            // If the current paragraph reaches approximately 72 words, add it to the paragraphs array and reset current paragraph
                            if (str_word_count($currentParagraph) >= 72) {
                                $paragraphs[] = $currentParagraph;
                                $currentParagraph = '';
                            }
                        }
                        // Add the remaining words as the last paragraph
                        if (!empty($currentParagraph)) {
                            $paragraphs[] = $currentParagraph;
                        }
                        @endphp
                        @foreach ($paragraphs as $paragraph)
                        <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                    
                    <!-- Blog Detail End -->
    
                    <!-- Comment List Start -->
                    <div class="mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">3 Comments</h3>
                        </div>
                        <div class="d-flex mb-4">
                            <img src="{{ asset('backend/assets-1') }}/img/user.jpg" class="img-fluid rounded" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                    accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                                <button class="btn btn-sm btn-light">Reply</button>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <img src="{{ asset('backend/assets-1') }}/img/user.jpg" class="img-fluid rounded" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                    accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                                <button class="btn btn-sm btn-light">Reply</button>
                            </div>
                        </div>
                        <div class="d-flex ms-5 mb-4">
                            <img src="{{ asset('backend/assets-1') }}/img/user.jpg" class="img-fluid rounded" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                    accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                                <button class="btn btn-sm btn-light">Reply</button>
                            </div>
                        </div>
                    </div>
                    <!-- Comment List End -->
    
                    <!-- Comment Form Start -->
                    <div class="bg-light rounded p-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Leave A Comment</h3>
                        </div>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control bg-white border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control bg-white border-0" placeholder="Website" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control bg-white border-0" rows="5" placeholder="Comment"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Leave Your Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Comment Form End -->
                </div>
    
                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <!-- Search Form Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Keyword">
                            <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <!-- Search Form End -->
    
                    <!-- Category Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Categories</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                        @foreach ($categories as $category)
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="{{ route('public.blogs.index') }}"><i class="bi bi-arrow-right me-2"></i>{{ $category->name }}</a>
                        @endforeach
                        </div>
                    </div>
                    <!-- Category End -->
    
                    <!-- Recent Post Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Recent Post</h3>
                        </div>
                        @foreach ($latestBlogs as $blog)
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ Storage::url($blog->blog_image_path) }}" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="{{ route('public.blogs.show', $blog->id) }}" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">{{ $blog->name }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <!-- Recent Post End -->
    
                    <!-- Image Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <img src="{{ asset('backend/assets-1') }}/img/blog-1.jpg" alt="" class="img-fluid rounded">
                    </div>
                    <!-- Image End -->
    
                    <!-- Tags Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Tag Cloud</h3>
                        </div>
                        <div class="d-flex flex-wrap m-n1">
                        @foreach ($tags as $tag)
                           <a href="{{ route('public.blogs.index') }}" class="btn btn-light m-1">{{ $tag->name }}</a>
                        @endforeach
                        </div>
                    </div>
                    <!-- Tags End -->
    
                    <!-- Plain Text Start -->
                    <div class="wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Plain Text</h3>
                        </div>
                        <div class="bg-light text-center" style="padding: 30px;">
                            <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet diam</p>
                            <a href="" class="btn btn-primary py-2 px-4">Read More</a>
                        </div>
                    </div>
                    <!-- Plain Text End -->
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Blog End -->


{{-- footer --}}
  @include('publics.pages.footer')
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>
    {{-- js --}}
  @include('publics.layouts.js-1')
</body>

</html>




