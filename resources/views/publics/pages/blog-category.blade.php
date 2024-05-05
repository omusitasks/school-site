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
                    <h1 class="display-4 text-white animated zoomIn">List of Blogs</h1>
                    <a href="{{ route('welcome.index') }}" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="{{ route('public.blogs.index') }}" class="h5 text-white">In Your Selected Category</a>
                </div>
            </div>
        </div>
</div>
<!-- Navbar End -->


<!-- Blog Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-8">
                    <div class="row g-5">

                    @foreach ($blogs as $blog)
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="{{ Storage::url($blog->blog_image_path) }}" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="{{ route('public.blogs.show', $blog->id) }}">{{ $blog->category_name }}</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>{{ $blog->author }}</small>

                                        <!-- Calculate duration for this blog entry -->

                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</small>

                                        <!-- <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small> -->
                                    </div>
                                    <h4 class="mb-3">{{ $blog->name }}</h4>
                                    <p>
                                         <!-- Display the first 30 words of the description followed by ellipses -->
                                        @php
                                        $description = explode(' ', $blog->description);
                                        $firstThirtyWords = implode(' ', array_slice($description, 0, 10));
                                        echo $firstThirtyWords . (count($description) > 10 ? ' ...' : '');
                                        @endphp
                                    </p>
                                    <a class="text-uppercase" href="{{ route('public.blogs.show', $blog->id) }}">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                        <!-- PAGINATION -->
                        <div class="col-12 wow slideInUp" data-wow-delay="0.1s">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-lg m-0">
                                    <li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link rounded-0" href="{{ $blogs->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                                        </a>
                                    </li>
                                    @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                        <li class="page-item {{ $blogs->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $blogs->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item {{ $blogs->currentPage() == $blogs->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link rounded-0" href="{{ $blogs->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- Blog list End -->
    
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
                        @foreach ($category_blog as $category)
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="{{ route('public-blog-category.blogs.indexCategoryTagBlog') }}"><i class="bi bi-arrow-right me-2"></i>{{ $category->name }}</a>
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
                            <a href="{{ route('public.blogs.index', $blog->id) }}" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">{{ $blog->name }}
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
                            @foreach ($tag_blog as $tag)
                            <a href="{{ route('public-blog-category.blogs.indexCategoryTagBlog') }}" class="btn btn-light m-1">{{ $tag->name }}</a>
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
                            <a href="{{ route('public.about.index') }}" class="btn btn-primary py-2 px-4">Read More</a>
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




