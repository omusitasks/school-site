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
                @auth
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Blog access') || Auth::user()->hasPermissionTo('Blog edit') || Auth::user()->hasPermissionTo('Blog create') || Auth::user()->hasPermissionTo('Blog delete') || Auth::user()->hasPermissionTo('Tag access') || Auth::user()->hasPermissionTo('Tag edit') || Auth::user()->hasPermissionTo('Tag create') || Auth::user()->hasPermissionTo('Tag delete') || Auth::user()->hasPermissionTo('BlogCategory access') || Auth::user()->hasPermissionTo('BlogCategory edit') || Auth::user()->hasPermissionTo('BlogCategory create') || Auth::user()->hasPermissionTo('BlogCategory delete'))
                <li class=" ">
                    <a href="#setting" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="ml-4">Blog Mgnt</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="setting" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Tag access') || Auth::user()->hasPermissionTo('Tag edit') || Auth::user()->hasPermissionTo('Tag create') || Auth::user()->hasPermissionTo('Tag delete'))
                        <li class="">
                            <a href="{{ route('tags_info.index') }}" class="">
                                <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span class="ml-4">Blog Tags</span>
                            </a>
                        </li>
                        @endif
                        
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('BlogCategory access') || Auth::user()->hasPermissionTo('BlogCategory edit') || Auth::user()->hasPermissionTo('BlogCategory create') || Auth::user()->hasPermissionTo('BlogCategory delete'))
                        <li class="">
                            <a href="{{ route('blog-categories.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Blog Categories</span>
                            </a>
                        </li>
                        @endif
                        
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('Blog access') || Auth::user()->hasPermissionTo('Blog edit') || Auth::user()->hasPermissionTo('Blog create') || Auth::user()->hasPermissionTo('Blog delete'))
                        <li class="">
                            <a href="{{ route('blogs.index') }}" class="">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Blogs</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @endauth



                <!-----------------------------------------------
                -------------------System Blogs ENDS HERE-----------------------
                ------------------------------------------------->





                
                <!-----------------------------------------------
                -------------------System cLASS STARTS HERE-----------------------
                ------------------------------------------------->

                <li class=" ">
                    <a href="#return" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash6" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line>
                        </svg>
                        <span class="ml-4">Class</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="return" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                    <a href="{{ route('classes.index') }}">
                                        <i class="las la-minus"></i><span>Class</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="{{ route('subjects.index') }}">
                                        <i class="las la-minus"></i><span>Subject</span>
                                    </a>
                            </li>
                    </ul>
                </li>
                <!-----------------------------------------------
                -------------------students-----------------------
                ------------------------------------------------->
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
                                        <i class="las la-minus"></i><span>Admission Form</span>
                                    </a>
                            </li>
                            <li class="">
                                <a href="{{ route('studdentpromotion.index') }}">
                                    <i class="las la-minus"></i><span>Students Promotion</span>
                                </a>
                        </li>
                    </ul>
                </li>



                <!-----------------------------------------------
                    -------------------Attendance-----------------------
                    ------------------------------------------------->
                <li class="">
                    <a href="{{ route('attendance.index') }}" class="">
                        <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span class="ml-4">Attendance</span>
                    </a>
                    <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                    </ul>
                </li>


                <!-----------------------------------------------
                -------------------Examinations-----------------------
                ------------------------------------------------->

                <li class="">
                    <a href="#Examinations" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z"/>
                          </svg>
                        <span class="ml-4">Examinations</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="Examinations" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
                            <li class="">
                                <a href="{{ route('exams.index') }}" class="svg-icon">
                                    <svg class="svg-icon" id="p-dash07" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    <span class="ml-4">Exams</span>
                                </a> 
                            </li>
                            <li class=" ">
                                <a href="#Examsschedules" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" id="p-dash10" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline>
                                    </svg>
                                    <span class="ml-4">Exams schedules</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="Examsschedules" class="iq-submenu collapse" data-parent="#Examsschedules" style="">
                                        <li class="">
                                            <a href="{{ route('examsschedules.index') }}">
                                                <i class="las la-minus"></i><span>Schedules</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('examsschedules.create') }}">
                                                <i class="las la-minus"></i><span>Schedules Create</span>
                                            </a>
                                        </li>
                                </ul>
                            </li>

                            <li class=" ">
                                <a href="#MarksRegistration" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5z"/>
                                      </svg>
                                    <span class="ml-4">Marks Registration</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="MarksRegistration" class="iq-submenu collapse" data-parent="#MarksRegistration" style="">
                                        <li class="">
                                            <a href="{{ route('exammarksregistrations.index') }}">
                                                <i class="las la-minus"></i><span>Exam Marks</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('exammarksregistrations.create') }}">
                                                <i class="las la-minus"></i><span>Marks Registration</span>
                                            </a>
                                        </li>
                                </ul>
                            </li>

                    </ul>
                </li>

                <!-----------------------------------------------
                -------------------Result-----------------------
                ------------------------------------------------->

                <li class=" ">
                    <a href="#Result" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>
                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                          </svg>
                        <span class="ml-4">Result</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="Result" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                    <a href="{{ route('results.index') }}">
                                        <i class="las la-minus"></i><span>Result</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="{{ route('results.create') }}">
                                        <i class="las la-minus"></i><span>Create Result</span>
                                    </a>
                            </li>
                    </ul>
                </li>


                <!-----------------------------------------------
                -------------------Salary-----------------------
                ------------------------------------------------->

                <li class=" ">
                    <a href="#Salary" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                            <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
                          </svg>
                        <span class="ml-4">Salary</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="Salary" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                    <a href="{{ route('salarysheet.create') }}">
                                        <i class="las la-minus"></i><span>Salary Sheets</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="{{ route('salary.index') }}">
                                        <i class="las la-minus"></i><span>Salary</span>
                                    </a>
                            </li>
                    </ul>
                </li>

                <!-----------------------------------------------
                -------------------Accounts-----------------------
                ------------------------------------------------->

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
                                    <a href="{{ route('feecollections.index') }}">
                                        <i class="las la-minus"></i><span>All Fee Collection</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="{{ route('expenses.index') }}">
                                        <i class="las la-minus"></i><span>Expense</span>
                                    </a>
                            </li>
                            <li class="">
                                    <a href="{{ route('expenses.create') }}">
                                        <i class="las la-minus"></i><span>Add Expense</span>
                                    </a>
                            </li>
                    </ul>
                </li>




                <!-----------------------------------------------
                -------------------System Management / setting-----------------------
                ------------------------------------------------->

@auth
@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete') || Auth::user()->hasPermissionTo('Role access') || Auth::user()->hasPermissionTo('Role edit') || Auth::user()->hasPermissionTo('Role create') || Auth::user()->hasPermissionTo('Role delete') || Auth::user()->hasPermissionTo('Permission access') || Auth::user()->hasPermissionTo('Permission edit') || Auth::user()->hasPermissionTo('Permission create') || Auth::user()->hasPermissionTo('Permission delete'))

                <li class="">
    <a href="#setting" class="collapsed" data-toggle="collapse" aria-expanded="false">
        <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
        </svg>
        <span class="ml-4">System Mgmt</span>
        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="10 15 15 20 20 15"></polyline>
            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
        </svg>
    </a>
    <ul id="setting" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
            
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('User access') || Auth::user()->hasPermissionTo('User edit') || Auth::user()->hasPermissionTo('User create') || Auth::user()->hasPermissionTo('User delete'))
                <li class="">
                    <a href="{{ route('users.index') }}" class="">
                        <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">User Mgmt</span>
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
    </ul>
</li>
@endif
@endauth


            </ul>
        </nav>

        <div class="p-3"></div>
    </div>
    </div> 