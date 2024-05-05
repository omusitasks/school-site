<!-- Carousel start -->

<div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
    @foreach ($slider as $index => $slide)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <img class="w-100" src="{{ Storage::url($slide->image_path) }}" alt="Slider Image">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 900px;">
                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">{{ $slide->title }}</h5>
                    <h1 class="display-1 text-white mb-md-4 animated zoomIn">{{ $slide->subtitle }}</h1>
                    <!-- <h1 class="display-1 text-white mb-md-4 animated zoomIn">This is a Learning, Creative & Innovative Digital Solution</h1> -->
                    <a href="{{ route('register') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Join Now</a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Read more</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Carousel end -->