<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Update Sliders</title>
      
      {{-- css --}}
      @include('dashbord.layouts.css')
    </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      {{-- left navbar --}}
        @include('dashbord.layouts.left_nav');

        {{-- top navbar --}}
        @include('dashbord.layouts.top_nav')

      <div class="content-page">
        {{-- main page --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div>

                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb ">
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-danger"><i class="ri-home-4-line mr-1 float-left"></i>Dashbord</a></li>
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard.sliders.index') }}" class="text-danger">Sliders List</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">List Sliders</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Edit Slider</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.sliders.update',$sliders->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method("PUT")
                        <div class="form-group">
                          <label for="exampleInputText">Title</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $sliders->title }}" name="title">

                           <label for="exampleInputFile">Current Slider Image</label>
                            @if ($sliders->image_path)
                                <img src="{{ Storage::url($sliders->image_path) }}" alt="Current Slider Image" style="max-width: 100px;">
                            @else
                                <p>No Slider Image uploaded</p>
                            @endif

                            <br>
                            <label for="exampleInputFile">New Slider Image</label>
                            <input type="file" class="form-control-file" id="exampleInputFile" name="image_path">
                            
                            <label for="exampleInputText">Sub-Title</label>
                            <input type="text" class="form-control" id="exampleInputText" value="{{ $sliders->subtitle }}" name="subtitle">


                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                     </form>
                   
                </div>
            </div>
        


        </div>
            <!-- Page end  -->
        </div>
      </div>
    </div>

  {{-- js --}}
  @include('dashbord.layouts.js')
  </body>
</html>