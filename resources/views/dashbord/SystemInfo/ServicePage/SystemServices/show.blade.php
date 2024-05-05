<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Services Detail View</title>
      
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
            <div class="container-fluid">

               <div class="row d-flex justify-content-start bg-light rounded">
                  <div class="col-lg-10 p-3">
                      <h2>{{ $service->name }}</h2>
                  <div style="display: flex; justify-content: space-between;">
                  <div>
                  <p>Created By | {{ $service->author }} | {{ $duration }}</p>
                  <!-- <p>Created On | {{ $service->created_at }}</p> -->
                  </div>
                  <div>
                  <p>Updated On | 
                  @if ($service->updated_at)
                  {{ $service->updated_at }}
                  @else
                  Not yet updated
                  @endif
                  </p>

                  </div>
                  </div>

                      
                  </div>
                  <div class="col-lg-2  pt-3 mb-1">
                      <div class="d-flex align-items-center m-0 list-action">
                          <a href="{{ route('dashboard.services.edit',$service->id) }}" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" ><i class="ri-pencil-line mr-0"></i></a>
                         
                          <form action="{{ route('dashboard.services.destroy',$service->id) }}" method="POST">
                              @csrf
                              @method("DELETE")
                              <button class="badge bg-warning mr-2 border-0" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" ><i class="ri-delete-bin-line mr-0"></i></button>
                          </form>
                      </div>
                  </div>
              </div>


              <div class="row bg-light rounded mt-3 p-3" title="general info">
               <div class="col-lg-4 col-md-6 col-sm-6">
                   <div class="card bg-white">
                      <div class="card-body">
                         <h5 class="card-title font-size-14">Name</h5>
                         <blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer font-size-15">{{ $service->name }} <cite title="Source Title" class="text-white"></cite></footer>
                         </blockquote>
                      </div>
                   </div>
                </div>

               <div class="col-lg-8 col-md-12 col-sm-12">
                   <div class="card bg-white">
                      <div class="card-body">
                         <h5 class="card-title font-size-14">Description</h5>
                         <blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer font-size-15">{{ $service->description }} <cite title="Source Title" class="text-white"></cite></footer>
                         </blockquote>
                      </div>
                   </div>
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