<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Create Project</title>
      
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
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard.projects.index') }}" class="text-danger">Project List</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Create Project</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">Create Project</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.projects.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputText">Title</label>
                           <input type="text" class="form-control" id="exampleInputText" name="name">

                           <label for="exampleInputText">Description</label>
                           <input type="text" class="form-control" id="exampleInputText" name="description">

                           <label for="exampleInputText">Project Type</label>
                           <select class="custom-select" required="" id="exampleInputText" name="project_types_id">
                                   <option value="">Open this select menu</option>
                                   @foreach($project_types as $project_types)
                                   <option value="{{$project_types->id}}">{{ $project_types->name }}</option>
                                  @endforeach
                            </select>

                           <label for="exampleInputText">Project Category</label>
                           <select class="custom-select" required="" id="exampleInputText" name="project_categories_id">
                                   <option value="">Open this select menu</option>
                                   @foreach($project_categories as $project_categories)
                                   <option value="{{$project_categories->id}}">{{ $project_categories->name }}</option>
                                  @endforeach
                            </select>

                            <label for="exampleInputText">Project Status</label>
                           <select class="custom-select" required="" id="exampleInputText" name="project_status_id">
                                   <option value="">Open this select menu</option>
                                   @foreach($project_status as $project_status)
                                   <option value="{{$project_status->id}}">{{ $project_status->name }}</option>
                                  @endforeach
                            </select>


                           <label for="exampleInputText">Project Budget</label>
                           <input type="number" class="form-control" id="exampleInputText" name="project_budget">
          

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-primary">New Order</button>
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