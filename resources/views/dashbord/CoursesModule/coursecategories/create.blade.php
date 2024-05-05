<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Create Blog</title>
      
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
                                   <li class="breadcrumb-item active" aria-current="page">Create Course Category</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Create Course Category</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.course_categories.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                           <label for="exampleInputText">Course Category Name</label>
                           <input type="text" class="form-control" id="exampleInputText" name="name">

                           <label for="exampleInputFile">Course Category Image</label>
                           <input type="file" class="form-control-file" id="exampleInputFile" name="course_category_image_path">

                           <label for="exampleInputText">Course Category Description</label>
                           <input type="text" class="form-control" id="exampleInputText" name="description">


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