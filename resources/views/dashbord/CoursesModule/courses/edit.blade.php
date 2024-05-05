<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Update Courses</title>
      
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
                                   <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Edit Course</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.courses.update',$courses->id) }}" method="POST"  enctype="multipart/form-data">
                      @csrf
                      @method("PUT")
                        <div class="form-group">
                            <label for="exampleInputText">Course Title</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $courses->name }}" name="name">

                           <label for="exampleInputText">Course Description</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $courses->description }}" name="description">

                           <label for="exampleInputText">Code</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $courses->code }}" name="code">

                           <label for="exampleInputText">Course Category</label>
                            <select class="custom-select" required id="exampleInputText" name="course_categories_id">
                                <option value="">Open this select menu</option>
                                @foreach($course_categories as $course_category)
                                    <option value="{{ $course_category->id }}" {{ $courses->course_categories_id == $course_category->id ? 'selected' : '' }}>
                                        {{ $course_category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <label for="exampleInputText">Course Type</label>
                            <select class="custom-select" required id="exampleInputText" name="course_types_id">
                                <option value="">Open this select menu</option>
                                @foreach($coursetypes as $coursetype)
                                    <option value="{{ $coursetype->id }}" {{ $courses->course_types_id == $coursetype->id ? 'selected' : '' }}>
                                        {{ $coursetype->name }}
                                    </option>
                                @endforeach
                            </select>


                           <label for="exampleInputText">Subscription Fee</label>
                           <input type="number" class="form-control" id="exampleInputText" value="{{ $courses->subscription_fee }}" name="subscription_fee">

                           <label for="exampleInputFile">Current Image</label>
                            @if ($courses->course_image_path)
                                <img src="{{ Storage::url($courses->course_image_path) }}" alt="Current Course Image" style="max-width: 100px;">
                            @else
                                <p>No image uploaded</p>
                            @endif

                            <br>
                            <label for="exampleInputFile">New Image</label>
                            <input type="file" class="form-control-file" id="exampleInputFile" name="course_image_path">

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