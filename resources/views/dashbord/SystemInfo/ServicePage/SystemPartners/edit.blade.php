<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Update Partners</title>
      
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
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard.partners.index') }}" class="text-danger">Partners List</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">List Partners</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Edit Partner</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.partners.update',$partners->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method("PUT")
                        <div class="form-group">
                          <label for="exampleInputText">Name</label>
                           <input type="text" class="form-control" id="exampleInputText" value="{{ $partners->name }}" name="name">

                           <label for="exampleInputFile">Current Partner Logo</label>
                            @if ($partners->partner_logo_path)
                                <img src="{{ Storage::url($partners->partner_logo_path) }}" alt="Current Student Image" style="max-width: 100px;">
                            @else
                                <p>No Partner Logo uploaded</p>
                            @endif

                            <br>
                            <label for="exampleInputFile">New Partner Logo</label>
                            <input type="file" class="form-control-file" id="exampleInputFile" name="partner_logo_path">
                            
                            <label for="exampleInputText">Description</label>
                            <input type="text" class="form-control" id="exampleInputText" value="{{ $partners->description }}" name="description">


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