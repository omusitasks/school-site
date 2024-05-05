<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Update Course Category</title>
      
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
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard.course_categories.index') }}" class="text-danger">Course Category List</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Edit Course Category</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Edit Course Category</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.course_categories.update',$course_categories->id) }}" method="POST"  enctype="multipart/form-data">
                      @csrf
                      @method("PUT")
                        <div class="form-group">
                            <label for="exampleInputText">Course Category Name</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $course_categories->name }}" name="name">

                           <label for="exampleInputText">Course Category Description</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $course_categories->description }}" name="description">

                           <label for="exampleInputFile">Current Image</label>
                            @if ($course_categories->course_category_image_path)
                                <img src="{{ Storage::url($course_categories->course_category_image_path) }}" alt="Current Course Category Image" style="max-width: 100px;">
                            @else
                                <p>No image uploaded</p>
                            @endif

                            <br>
                            <label for="exampleInputFile">New Image</label>
                            <input type="file" class="form-control-file" id="exampleInputFile" name="course_category_image_path">

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