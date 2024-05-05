<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Create Courses</title>
      
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
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard.courses.index') }}" class="text-danger">Courses List</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Create Courses</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Create Courses</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.courses.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                           <label for="exampleInputText">Title</label>
                           <input type="text" class="form-control" id="exampleInputText" name="name">

                           <label for="exampleInputText">Description</label>
                           <input type="text" class="form-control" id="exampleInputText" name="description">

                           <label for="exampleInputText">Code</label>
                           <input type="text" class="form-control" id="exampleInputText" name="code">

                           <label for="exampleInputText">Course Category</label>
                           <select class="custom-select" required="" id="exampleInputText" name="course_categories_id">
                                   <option value="">Open this select menu</option>
                                   @foreach($course_categories as $course_categories)
                                   <option value="{{$course_categories->id}}">{{ $course_categories->name }}</option>
                                  @endforeach
                            </select>

                           <label for="exampleInputText">Course Type</label>
                           <select class="custom-select" required="" id="exampleInputText" name="course_types_id">
                                   <option value="">Open this select menu</option>
                                   @foreach($coursetypes as $coursetypes)
                                   <option value="{{$coursetypes->id}}">{{ $coursetypes->name }}</option>
                                  @endforeach
                            </select>

                            <label for="exampleInputFile">Course Image</label>
                            <input type="file" class="form-control-file" id="exampleInputFile" name="course_image_path">


                           <label for="exampleInputText">Subscription Fee</label>
                           <input type="number" class="form-control" id="exampleInputText" name="subscription_fee">
          

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