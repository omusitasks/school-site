<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Create Testmonials</title>
      
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
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard.testimonials.index') }}" class="text-danger">Testimonials List</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Create Testimonials</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Create Testimonials</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label for="exampleInputText">Name</label>
                           <input type="text" class="form-control" id="exampleInputText" name="student_name">

                           <label for="exampleInputFile">Image</label>
                           <input type="file" class="form-control-file" id="exampleInputFile" name="student_image_path">

                           <label for="exampleInputText">Profesion</label>
                           <input type="text" class="form-control" id="exampleInputText" name="student_course">

                           <label for="exampleInputText">Testimonial Message</label>
                           <input type="text" class="form-control" id="exampleInputText"  name="testmonial_message">


                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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