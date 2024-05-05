<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | Blog Detail View</title>
      
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
                  <!-- <div class="col-lg-2 p-1 bg-light">
                      <img class="avatar-100 rounded "
                          src="{{ asset('storage/app/public/upload/blogs_image/'.$blog->image ?? '10.PNG' ) }}" 
                        >
                  </div> -->
                  <div class="col-lg-10 p-3">
                      <h2>{{ $blog->name }}</h2>
                  <div style="display: flex; justify-content: space-between;">
                  <div>
                  <p>Created By | {{ $blog->author }} | {{ $duration }}</p>
                  <!-- <p>Created On | {{ $blog->created_at }}</p> -->
                  </div>
                  <div>
                  <p>Updated On | 
                  @if ($blog->updated_at)
                  {{ $blog->updated_at }}
                  @else
                  Not yet updated
                  @endif
                  </p>
                  </div>
                  </div>

                      
                  </div>
                  <div class="col-lg-2  pt-3 mb-1">
                      <div class="d-flex align-items-center m-0 list-action">
                          <a href="{{ route('dashboard.blogs.edit',$blog->id) }}" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" ><i class="ri-pencil-line mr-0"></i></a>
                         
                          <form action="{{ route('dashboard.blogs.destroy',$blog->id) }}" method="POST">
                              @csrf
                              @method("DELETE")
                              <button class="badge bg-warning mr-2 border-0" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" ><i class="ri-delete-bin-line mr-0"></i></button>
                          </form>
                      </div>
                  </div>
              </div>


              <div class="row bg-light rounded mt-3 p-3" title="general info">
               <div class="col-lg-6 col-md-6 col-sm-6">
                   <div class="card bg-white">
                      <div class="card-body">
                         <h5 class="card-title font-size-14">Name</h5>
                         <blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer font-size-15">{{ $blog->name }} <cite title="Source Title" class="text-white"></cite></footer>
                         </blockquote>
                      </div>
                   </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
               <div class="card bg-white">
                  <div class="card-body">
                     <h5 class="card-title font-size-14">Tags</h5>
                     <blockquote class="blockquote mb-0">
                        <footer class="blockquote-footer font-size-15">{{ $blog->tag_name }} <cite title="Source Title" class="text-white"></cite></footer>
                     </blockquote>
                  </div>
               </div>
            </div>

               

               <div class="col-lg-3 col-md-6 col-sm-6">
                   <div class="card bg-white">
                      <div class="card-body">
                         <h5 class="card-title font-size-14">Category</h5>
                         <blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer font-size-15">{{ $blog->category_name }} <cite title="Source Title" class="text-white"></cite></footer>
                         </blockquote>
                      </div>
                   </div>
                </div>  


               <div class="col-lg-12 col-md-12 col-sm-12">
                   <div class="card bg-white">
                      <div class="card-body">
                         <h5 class="card-title font-size-14">Description</h5>
                         <blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer font-size-15">{{ $blog->description }} <cite title="Source Title" class="text-white"></cite></footer>
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