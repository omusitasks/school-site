<div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="{{ asset('backend/assets') }}/images/logo.png" class="img-fluid rounded-normal light-logo" alt="logo"><h5 class="logo-title light-logo ml-3">The Buffalo Academy</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="active">
                    <a href="{{ route('dashboard') }}" class="svg-icon">                        
                        <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="ml-4">Dashboards</span>
                    </a>
                </li>



                <!-----------------------------------------------
                -------------------System Blogs STARTS HERE-----------------------
                ------------------------------------------------->
               <li class=" ">
                    <a href="#Results" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="ml-4">Blog Mgnt</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="Results" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                        <li class="">
                            <a href="{{ route('dashboard.tags.index') }}" class="">
                                <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span class="ml-4">Blog Tags</span>
                            </a>
                        </li>
                        
                        <li class="">
                            <a href="{{ route('dashboard.blog_categories.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Blog Categories</span>
                            </a>
                        </li>
                        
                        <li class="">
                            <a href="{{ route('dashboard.blogs.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Blogs</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>



                <!-----------------------------------------------
                -------------------System Blogs ENDS HERE-----------------------
                ------------------------------------------------->




                 <!-----------------------------------------------
                -------------------System Courses STARTS HERE-----------------------
                ------------------------------------------------->
                @auth
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Course access') || Auth::user()->hasPermissionTo('Course edit') || Auth::user()->hasPermissionTo('Course create') || Auth::user()->hasPermissionTo('Course delete') || Auth::user()->hasPermissionTo('CourseType access') || Auth::user()->hasPermissionTo('CourseType edit') || Auth::user()->hasPermissionTo('CourseType create') || Auth::user()->hasPermissionTo('CourseType delete') || Auth::user()->hasPermissionTo('CourseCategory access') || Auth::user()->hasPermissionTo('CourseCategory edit') || Auth::user()->hasPermissionTo('CourseCategory create') || Auth::user()->hasPermissionTo('CourseCategory delete'))
                <li class=" ">
                <a href="#Result" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>
                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                          </svg>
                        <span class="ml-4">Courses Mgnt</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="Result" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('CourseType access') || Auth::user()->hasPermissionTo('CourseType edit') || Auth::user()->hasPermissionTo('CourseType create') || Auth::user()->hasPermissionTo('CourseType delete'))
                        <li class="">
                            <a href="{{ route('dashboard.coursetypes.index') }}" class="">
                                <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span class="ml-4">Course Types</span>
                            </a>
                        </li>
                        @endif
                        
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('CourseCategory access') || Auth::user()->hasPermissionTo('CourseCategory edit') || Auth::user()->hasPermissionTo('CourseCategory create') || Auth::user()->hasPermissionTo('CourseCategory delete'))
                        <li class="">
                            <a href="{{ route('dashboard.course_categories.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Course Categories</span>
                            </a>
                        </li>
                        @endif
                        
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Course access') || Auth::user()->hasPermissionTo('Course edit') || Auth::user()->hasPermissionTo('Course create') || Auth::user()->hasPermissionTo('Course delete'))
                        <li class="">
                            <a href="{{ route('dashboard.courses.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Courses</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @endauth



                <!-----------------------------------------------
                -------------------System Courses ENDS HERE-----------------------
                ------------------------------------------------->






                                 <!-----------------------------------------------
                -------------------System Projects STARTS HERE-----------------------
                ------------------------------------------------->
                @auth
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Project access') || Auth::user()->hasPermissionTo('Project edit') || Auth::user()->hasPermissionTo('Project create') || Auth::user()->hasPermissionTo('Project delete') || Auth::user()->hasPermissionTo('ProjectType access') || Auth::user()->hasPermissionTo('ProjectType edit') || Auth::user()->hasPermissionTo('ProjectType create') || Auth::user()->hasPermissionTo('ProjectType delete') || Auth::user()->hasPermissionTo('ProjectCategory access') || Auth::user()->hasPermissionTo('ProjectCategory edit') || Auth::user()->hasPermissionTo('ProjectCategory create') || Auth::user()->hasPermissionTo('ProjectCategory delete') || Auth::user()->hasPermissionTo('ProjectStatus access') || Auth::user()->hasPermissionTo('ProjectStatus edit') || Auth::user()->hasPermissionTo('ProjectStatus create') || Auth::user()->hasPermissionTo('ProjectStatus delete'))
                <li class=" ">
                <a href="#Salary" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                            <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
                          </svg>
                        <span class="ml-4">Projects Mgnt</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="Salary" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('ProjectType access') || Auth::user()->hasPermissionTo('ProjectType edit') || Auth::user()->hasPermissionTo('ProjectType create') || Auth::user()->hasPermissionTo('ProjectType delete'))
                        <li class="">
                            <a href="{{ route('dashboard.projecttypes.index') }}" class="">
                                <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span class="ml-4">Project Types</span>
                            </a>
                        </li>
                        @endif
                        
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('ProjectCategory access') || Auth::user()->hasPermissionTo('ProjectCategory edit') || Auth::user()->hasPermissionTo('ProjectCategory create') || Auth::user()->hasPermissionTo('ProjectCategory delete'))
                        <li class="">
                            <a href="{{ route('dashboard.project_categories.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Project Categories</span>
                            </a>
                        </li>
                        @endif


                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('ProjectStatus access') || Auth::user()->hasPermissionTo('ProjectStatus edit') || Auth::user()->hasPermissionTo('ProjectStatus create') || Auth::user()->hasPermissionTo('ProjectStatus delete'))
                        <li class="">
                            <a href="{{ route('dashboard.project_status.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Project Status</span>
                            </a>
                        </li>
                        @endif
                        
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Project access') || Auth::user()->hasPermissionTo('Project edit') || Auth::user()->hasPermissionTo('Project create') || Auth::user()->hasPermissionTo('Project delete'))
                        <li class="">
                            <a href="{{ route('dashboard.projects.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Projects</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @endauth



                <!-----------------------------------------------
                -------------------System Projects ENDS HERE-----------------------
                ------------------------------------------------->






                <!-----------------------------------------------
                -------------------students STARTS HERE-----------------------
                ------------------------------------------------->
                @auth
@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete'))

                <li class=" ">
                    <a href="#people" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">Students Mgnt</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="people" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                    <a href="{{ route('students.index') }}">
                                        <i class="las la-minus"></i><span>All Students</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="{{ route('students.create') }}">
                                        <i class="las la-minus"></i><span>Add Students</span>
                                    </a>
                            </li>
                            <li class="">
                                <a href="{{ route('studdentpromotion.index') }}">
                                    <i class="las la-minus"></i><span>Enrolled Students</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('studdentpromotion.index') }}">
                                    <i class="las la-minus"></i><span>Students + Courses</span>
                                </a>
                            </li>
                    </ul>
                </li>
                @endif
@endauth




                <!-----------------------------------------------
                -------------------Accounts-----------------------
                ------------------------------------------------->
                @auth
@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete'))

                <li class=" ">
                    <a href="#expense" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash4" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                        </svg>
                        <span class="ml-4">Accounts Mgnt</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="expense" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                    <a href="">
                                        <i class="las la-minus"></i><span>Subscribed Students</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="">
                                        <i class="las la-minus"></i><span>My Subscription</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="">
                                        <i class="las la-minus"></i><span>Payment History</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="">
                                        <i class="las la-minus"></i><span>Payment Method</span>
                                    </a>
                            </li>
                    </ul>
                </li>
                @endif
@endauth




                <!-----------------------------------------------
                -------------------USER Management / STARTS HERE-----------------------
                ------------------------------------------------->


                @auth
@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete'))

                <li class="">
    <a href="#return" class="collapsed" data-toggle="collapse" aria-expanded="false">
    <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
        <span class="ml-4">User Mgmt</span>
        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="10 15 15 20 20 15"></polyline>
            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
        </svg>
    </a>
    <ul id="return" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
            
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete') || Auth::user()->hasRole('tutor'))
                <li class="">
                    <a href="{{ route('dashboard.users.index') }}" class="">
                    <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">Users</span>
                    </a>
                </li>
                @endif


                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete'))
                <li class="">
                    <a href="{{ route('tutors.tutors') }}" class="">
                    <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">All Tutors</span>
                    </a>
                </li>
                @endif

                
                
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete'))
                <li class="">
                    <a href="{{ route('students.students') }}" class="">
                    <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">All Students</span>
                    </a>
                </li>
                @endif
                
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete'))
                <li class="">
                    <a href="{{ route('clients.clients') }}" class="">
                    <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">All Clients</span>
                    </a>
                </li>
            @endif
    </ul>
</li>
@endif
@endauth


                <!-----------------------------------------------
                -------------------USER Management / ENDS HERE-----------------------
                ------------------------------------------------->
                




                <!-----------------------------------------------
                -------------------System Management / setting STARTS HERE-----------------------
                ------------------------------------------------->

@auth
@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Role access') || Auth::user()->hasPermissionTo('Role edit') || Auth::user()->hasPermissionTo('Role create') || Auth::user()->hasPermissionTo('Role delete') || Auth::user()->hasPermissionTo('Permission access') || Auth::user()->hasPermissionTo('Permission edit') || Auth::user()->hasPermissionTo('Permission create') || Auth::user()->hasPermissionTo('Permission delete'))

                <li class="">
    <a href="#setting" class="collapsed" data-toggle="collapse" aria-expanded="false">
    <svg class="svg-icon" id="p-dash6" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line>
                        </svg>
        <span class="ml-4">System Mgmt</span>
        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="10 15 15 20 20 15"></polyline>
            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
        </svg>
    </a>
    <ul id="setting" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
            
                
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Role access') || Auth::user()->hasPermissionTo('Role edit') || Auth::user()->hasPermissionTo('Role create') || Auth::user()->hasPermissionTo('Role delete'))
                <li class="">
                    <a href="{{ route('roles.index') }}" class="">
                        <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span class="ml-4">Role Mgmt</span>
                    </a>
                </li>
                @endif

                
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Permission access') || Auth::user()->hasPermissionTo('Permission edit') || Auth::user()->hasPermissionTo('Permission create') || Auth::user()->hasPermissionTo('Permission delete'))
                <li class="">
                    <a href="{{ route('permissions.index') }}" class="">
                        <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span class="ml-4">Permission Mgmt</span>
                    </a>
                </li>
                @endif


                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Role access') || Auth::user()->hasPermissionTo('Role edit') || Auth::user()->hasPermissionTo('Role create') || Auth::user()->hasPermissionTo('Role delete'))
                <li class="">
                    <a href="{{ route('roles.index') }}" class="">
                        <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span class="ml-4">System Audit Trail</span>
                    </a>
                </li>
                @endif

    </ul>
</li>
@endif
@endauth

<!-----------------------------------------------
                -------------------System Management / setting ENDS HERE-----------------------
                ------------------------------------------------->




                 <!-----------------------------------------------
                -------------------System Information STARTS HERE-----------------------
                ------------------------------------------------->
                <li class="">
                    <a href="#Examinations" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z"/>
                          </svg>
                        <span class="ml-4">System Information</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="Examinations" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">

                            <!-- System All Pages/General Layouts -->
                            <li class=" ">
                                <a href="#AllPages" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" id="p-dash10" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline>
                                    </svg>
                                    <span class="ml-4">All Pages Info</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="AllPages" class="iq-submenu collapse" data-parent="#AllPages" style="">
                                        <li class="">
                                            <a href="{{ route('dashboard.icons.index') }}">
                                                <i class="las la-minus"></i><span>System Icons</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('dashboard.contact_information.index') }}">
                                                <i class="las la-minus"></i><span>System Contact Info</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('dashboard.email_information.index') }}">
                                                <i class="las la-minus"></i><span>System Email Info</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('dashboard.address_information.index') }}">
                                                <i class="las la-minus"></i><span>System Address Info</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('dashboard.social_media.index') }}">
                                                <i class="las la-minus"></i><span>System Social Media</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('dashboard.social_media.index') }}">
                                                <i class="las la-minus"></i><span>System Title/Logo</span>
                                            </a>
                                            <!-- <a href="{{ route('dashboard.title_logo.index') }}">
                                                <i class="las la-minus"></i><span>System Title/Logo</span>
                                            </a> -->
                                        </li>
                                        <li class="">
                                            <a href="{{ route('dashboard.social_media.index') }}">
                                                <i class="las la-minus"></i><span>System Page Header</span>
                                            </a>
                                            <!-- <a href="{{ route('dashboard.page_header.index') }}">
                                                <i class="las la-minus"></i><span>System Page Header</span>
                                            </a> -->
                                        </li>
                                </ul>
                            </li>


                            <!-- // Homepage -->
                            <li class=" ">
                                <a href="#HomePage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
                                      </svg>
                                    <span class="ml-4">Home Page</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="HomePage" class="iq-submenu collapse" data-parent="#HomePage" style="">
                                        <li class="">
                                            <a href="{{ route('dashboard.sliders.index') }}">
                                                <i class="las la-minus"></i><span>System Slider</span>
                                            </a>
                                        </li>
                                </ul>
                            </li>


                            <!-- // ServicePage -->
                            <li class=" ">
                                <a href="#ServicePage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
                                      </svg>
                                    <span class="ml-4">Service Page</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="ServicePage" class="iq-submenu collapse" data-parent="#ServicePage" style="">
                                        <li class="">
                                            <a href="{{ route('dashboard.services.index') }}">
                                                <i class="las la-minus"></i><span>System Services</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('dashboard.testimonials.index') }}">
                                                <i class="las la-minus"></i><span>System Testimonials</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('dashboard.partners.index') }}">
                                                <i class="las la-minus"></i><span>System Partners</span>
                                            </a>
                                        </li>
                                </ul>
                            </li>

                            <!-- // Contact Page -->
                            <li class=" ">
                                <a href="#ContactPage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
                                      </svg>
                                    <span class="ml-4">Contact Page</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="ContactPage" class="iq-submenu collapse" data-parent="#ContactPage" style="">
                                        <li class="">
                                            <a href="{{ route('dashboard.contactus.index') }}">
                                                <i class="las la-minus"></i><span>Contact Messaging</span>
                                            </a>
                                        </li>
                                </ul>
                            </li>



                            <!-- // About Page -->
                            <li class=" ">
                                <a href="#AboutPage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
                                      </svg>
                                    <span class="ml-4">About Page</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="AboutPage" class="iq-submenu collapse" data-parent="#AboutPage" style="">
                                        <li class="">
                                            <a href="{{ route('dashboard.social_media.index') }}">
                                                <i class="las la-minus"></i><span>System About</span>
                                            </a>
                                            <!-- <a href="{{ route('dashboard.aboutus.index') }}">
                                                <i class="las la-minus"></i><span>System About</span>
                                            </a> -->
                                        </li>
                                </ul>
                            </li>


                            <!-- // AI Page -->
                            <li class=" ">
                                <a href="#aiPage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
                                      </svg>
                                    <span class="ml-4">AI Page</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="aiPage" class="iq-submenu collapse" data-parent="#aiPage" style="">
                                        <li class="">
                                            <a href="{{ route('dashboard.social_media.index') }}">
                                                <i class="las la-minus"></i><span>System AI</span>
                                            </a>
                                            <!-- <a href="{{ route('dashboard.ai.index') }}">
                                                <i class="las la-minus"></i><span>System AI</span>
                                            </a> -->
                                        </li>
                                </ul>
                            </li>

                    </ul>
                </li>


                 <!-----------------------------------------------
                -------------------System Information STARTS HERE-----------------------
                ------------------------------------------------->


            </ul>
        </nav>

        <div class="p-3"></div>
    </div>
    </div> 
