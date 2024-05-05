<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Update Testimonial</title>
      
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
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard.testimonials.index') }}" class="text-danger">Testimonial List</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">List Testimonial</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Edit Testimonial</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.testimonials.update',$testimonials->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method("PUT")
                        <div class="form-group">
                          <label for="exampleInputText">Name</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $testimonials->student_name }}" name="student_name">

                           <label for="exampleInputFile">Current Image</label>
                            @if ($testimonials->student_image_path)
                                <img src="{{ Storage::url($testimonials->student_image_path) }}" alt="Current Student Image" style="max-width: 100px;">
                            @else
                                <p>No image uploaded</p>
                            @endif

                            <br>
                            <label for="exampleInputFile">New Image</label>
                            <input type="file" class="form-control-file" id="exampleInputFile" name="student_image_path">

                           <label for="exampleInputText">Profesion</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $testimonials->student_course }}" name="student_course">

                           <label for="exampleInputText">Testimonial Message</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $testimonials->testmonial_message }}" name="testmonial_message">


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