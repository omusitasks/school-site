<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Create Social Media</title>
      
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
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard.social_media.index') }}" class="text-danger">Social Media List</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Create Social Media</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Create Social Media</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.social_media.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputText">Media Name</label>
                           <input type="text" class="form-control" id="exampleInputText" name="name">

                           <label for="exampleInputText">Media Icon</label>
                           <select class="custom-select" required="" id="exampleInputText" name="icons_id">
                                   <option value="">Open this select menu</option>
                                   @foreach($icons as $icons)
                                   <option value="{{$icons->id}}">{{ $icons->name }}</option>
                                  @endforeach
                            </select>


                           <label for="exampleInputText">Media Link</label>
                           <input type="text" class="form-control" id="exampleInputText" name="link">

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