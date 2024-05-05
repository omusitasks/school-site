<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashbord | List of Courses</title>
      
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
                                   <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-danger"><i class="ri-home-4-line mr-1 float-left"></i>Home</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">List of Courses</li>
                                </ol>
                             </nav>

                            <h4 class="mb-3">List of Courses</h4>
                        </div>
                        @if (Auth::user()->hasPermissionTo('Course create'))
                        <a href="{{ route('dashboard.courses.create') }}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Course</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
    <thead class="bg-white text-uppercase">
        <tr class="light light-data">
            <th>ls</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Code</th>
            <th>Category</th>
            <th>Type</th> 
            <th>Fee</th>  
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="light-body">
        @foreach ($courses as $course)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $course->name }}</td>

                <td>
                 <!-- Display the first 30 words of the description followed by ellipses -->
                 @php
                $description = explode(' ', $course->description);
                $firstThirtyWords = implode(' ', array_slice($description, 0, 10));
                echo $firstThirtyWords . (count($description) > 10 ? ' ...' : '');
                @endphp
                </td>

                <td>
                    @if ($course->course_image_path)
                    <!-- Display the image if available -->
                    <img src="{{ Storage::url($course->course_image_path) }}" alt="Course Image" style="max-width: 100px;">
                    @else
                    <!-- Display a placeholder if image is not available -->
                    No Image Uploaded
                    @endif
                </td>

                <td>{{ $course->code }}</td>
                <td>{{ $course->course_category_name }}</td>
                <td>{{ $course->course_type_name }}</td>
                <td>$ {{ $course->subscription_fee }}</td>
                <td>
                    <div class="d-flex align-items-center list-action">
                        @auth
                            @if (Auth::user()->hasRole('admin'))
                                <a href="{{ route('dashboard.courses.show', $course->id) }}" class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="View"><i class="ri-eye-line mr-0"></i></a>
                                <a href="{{ route('dashboard.courses.edit', $course->id) }}" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-pencil-line mr-0"></i></a>

                        

                                <form id="deleteCourseForm{{ $course->id }}" action="{{ route('dashboard.courses.destroy', $course->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button class="badge bg-warning mr-2 border-0" data-toggle="modal" data-target="#deleteConfirmationModal{{ $course->id }}" onclick="event.preventDefault()">
                                        <i class="ri-delete-bin-line mr-0"></i>
                                    </button>
                                </form>


                                    <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteConfirmationModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $course->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $course->id }}">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete {{ $course->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteCourseForm{{ $course->id }}').submit()">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @else
                                @if (Auth::user()->hasPermissionTo('course access'))
                                    <a href="{{ route('dashboard.courses.show', $course->id) }}" class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="View"><i class="ri-eye-line mr-0"></i></a>
                                @endif
                                @if (Auth::user()->hasPermissionTo('course edit'))
                                    <a href="{{ route('dashboard.courses.edit', $course->id) }}" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-pencil-line mr-0"></i></a>
                                @endif
                                @if (Auth::user()->hasPermissionTo('course delete'))
                                    <form action="{{ route('dashboard.courses.destroy', $course->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="badge bg-warning mr-2 border-0" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-line mr-0"></i></button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

                </div>
            </div>
        </div>
            <!-- Page end  -->
        </div>
      </div>
    </div>


    <script>
    // Handle form submission when "Delete" button in modal is clicked
    $('#deleteConfirmationModal{{ $course->id }}').on('show.bs.modal', function () {
        $(this).find('.btn-danger').on('click', function () {
            $('#deleteCourseForm{{ $course->id }}').submit();
        });
    });

    // Prevent form submission when cancel button is clicked
    $('#deleteConfirmationModal{{ $course->id }}').on('hidden.bs.modal', function () {
        $(this).find('.btn-secondary').off('click');
    });
    </script>


  {{-- js --}}
  @include('dashbord.layouts.js')
  </body>
</html>