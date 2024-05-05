<?php


    use App\Http\Controllers\Dashbord\ClassesController as ClassesController;
    use App\Http\Controllers\Dashbord\PermissionController as PermissionController;
    use App\Http\Controllers\Dashbord\RoleController as RoleController;
    use App\Http\Controllers\Dashbord\StudentController as StudentController;
    use App\Http\Controllers\Dashbord\StudentPromotionController as StudentPromotionController;
    use App\Http\Controllers\Dashbord\SubjectController as SubjectController;
    use App\Http\Controllers\Dashbord\UserController as UserController;
    use App\Http\Controllers\Dashbord\ProfileController as ProfileController;


    // BLOG MODULE
    use Modules\SystemBlog\App\Http\Controllers\BlogController as BlogController;
    use Modules\SystemBlog\App\Http\Controllers\BlogCategoriesController as BlogCategoriesController;
    use Modules\SystemBlog\App\Http\Controllers\TagsController as TagsController;

    // COURSE MODULE
    use Modules\systemCourses\App\Http\Controllers\CourseController;
    use Modules\systemCourses\App\Http\Controllers\CourseCategoriesController;
    use Modules\systemCourses\App\Http\Controllers\CourseTypeController;

    // PROJECT MODULE
    use Modules\systemProjects\App\Http\Controllers\ProjectController;
    use Modules\systemProjects\App\Http\Controllers\ProjectCategoriesController;
    use Modules\systemProjects\App\Http\Controllers\ProjectTypeController;
    use Modules\systemProjects\App\Http\Controllers\ProjectStatusController;

    // MAIN DASHBOARD
    use App\Http\Controllers\Dashbord\MainDashboardController;

        // SYSTEM INFORMATION
        use App\Http\Controllers\Dashbord\SystemInfo\IconsController;
        use App\Http\Controllers\Dashbord\SystemInfo\ContactMessagingController;
        use App\Http\Controllers\Dashbord\SystemInfo\ContactInfoController;
        use App\Http\Controllers\Dashbord\SystemInfo\SocialMediaController as SMController;
        use App\Http\Controllers\Dashbord\SystemInfo\SystemAboutController;
        use App\Http\Controllers\Dashbord\SystemInfo\SystemAIController;
        use App\Http\Controllers\Dashbord\SystemInfo\SystemPageHeaderController;
        use App\Http\Controllers\Dashbord\SystemInfo\SystemPartnersController;
        use App\Http\Controllers\Dashbord\SystemInfo\SystemServicesController;
        use App\Http\Controllers\Dashbord\SystemInfo\SystemSliderController;
        use App\Http\Controllers\Dashbord\SystemInfo\SystemTestimonialsController;
        use App\Http\Controllers\Dashbord\SystemInfo\SystemTitleLogoController;
        use App\Http\Controllers\Dashbord\SystemInfo\EmailInfoController;
        use App\Http\Controllers\Dashbord\SystemInfo\AddressInfoController;
        

    // PUBLIC
    use App\Http\Controllers\Public\WelcomeController;
    use App\Http\Controllers\Public\BlogPublicController;
    use App\Http\Controllers\Public\ContactController;
    use App\Http\Controllers\Public\SliderController;
    use App\Http\Controllers\Public\SocialMediaController;
    use App\Http\Controllers\Public\AiController;
    use App\Http\Controllers\Public\AboutController;
    use App\Http\Controllers\Public\ServicesController;
    use App\Http\Controllers\Public\CoursesController;



    // use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;


    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    ###############################           public routes   starts here  #######################

    // Route::get('/', function () {
    //     return view('publics.pages.welcome');
    // });
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');


    // slider
    Route::prefix('publics')->group(function () {
        Route::resource('/slider', SliderController::class)->names([
            'index' => 'public.slider.index',
            'create' => 'public.slider.create',
            'store' => 'public.slider.store',
            'show' => 'public.slider.show',
            'edit' => 'public.slider.edit',
            'update' => 'public.slider.update',
            'destroy' => 'public.slider.destroy',
        ]);
    });

    // social media

    // for topnavbar
    Route::prefix('publics')->group(function () {
        Route::resource('/topnavbar', SocialMediaController::class)->names([
            'index' => 'public.topnavbar.indexTopNavBar',
            'create' => 'public.topnavbar.create',
            'store' => 'public.topnavbar.store',
            'show' => 'public.topnavbar.show',
            'edit' => 'public.topnavbar.edit',
            'update' => 'public.topnavbar.update',
            'destroy' => 'public.topnavbar.destroy',
        ]);
    });

    


    // for footer
    Route::prefix('publics')->group(function () {
        Route::resource('/footer', SocialMediaController::class)->names([
            'index' => 'public.footer.indexFooter',
            'create' => 'public.footer.create',
            'store' => 'public.footer.store',
            'show' => 'public.footer.show',
            'edit' => 'public.footer.edit',
            'update' => 'public.footer.update',
            'destroy' => 'public.footer.destroy',
        ]);
    });


    // contact information
    // for topbar
    Route::prefix('publics')->group(function () {
        Route::resource('/contact_info', SocialMediaController::class)->names([
            'index' => 'public.contact_info.indexTopNavBar',
            'create' => 'public.contact_info.create',
            'store' => 'public.contact_info.store',
            'show' => 'public.contact_info.show',
            'edit' => 'public.contact_info.edit',
            'update' => 'public.contact_info.update',
            'destroy' => 'public.contact_info.destroy',
        ]);
    });


    // email information
    // for topbar
    Route::prefix('publics')->group(function () {
        Route::resource('/email_info', SocialMediaController::class)->names([
            'index' => 'public.email_info.indexTopNavBar',
            'create' => 'public.email_info.create',
            'store' => 'public.email_info.store',
            'show' => 'public.email_info.show',
            'edit' => 'public.email_info.edit',
            'update' => 'public.email_info.update',
            'destroy' => 'public.email_info.destroy',
        ]);
    });



    // address information
    // for topbar
    Route::prefix('publics')->group(function () {
        Route::resource('/address_info', SocialMediaController::class)->names([
            'index' => 'public.address_info.indexTopNavBar',
            'create' => 'public.address_info.create',
            'store' => 'public.address_info.store',
            'show' => 'public.address_info.show',
            'edit' => 'public.address_info.edit',
            'update' => 'public.address_info.update',
            'destroy' => 'public.address_info.destroy',
        ]);
    });


    // contact information
    // for Footer
    Route::prefix('publics')->group(function () {
        Route::resource('/contact_info', SocialMediaController::class)->names([
            'index' => 'public.contact_info.indexFooter',
            'create' => 'public.contact_info.create',
            'store' => 'public.contact_info.store',
            'show' => 'public.contact_info.show',
            'edit' => 'public.contact_info.edit',
            'update' => 'public.contact_info.update',
            'destroy' => 'public.contact_info.destroy',
        ]);
    });


    // email information
    // for Footer
    Route::prefix('publics')->group(function () {
        Route::resource('/email_info', SocialMediaController::class)->names([
            'index' => 'public.email_info.indexFooter',
            'create' => 'public.email_info.create',
            'store' => 'public.email_info.store',
            'show' => 'public.email_info.show',
            'edit' => 'public.email_info.edit',
            'update' => 'public.email_info.update',
            'destroy' => 'public.email_info.destroy',
        ]);
    });



    // address information
    // for Footer
    Route::prefix('publics')->group(function () {
        Route::resource('/address_info', SocialMediaController::class)->names([
            'index' => 'public.address_info.indexFooter',
            'create' => 'public.address_info.create',
            'store' => 'public.address_info.store',
            'show' => 'public.address_info.show',
            'edit' => 'public.address_info.edit',
            'update' => 'public.address_info.update',
            'destroy' => 'public.address_info.destroy',
        ]);
    });


    // Courses
    Route::prefix('publics')->group(function () {
        Route::resource('/courses', CoursesController::class)->names([
            'index' => 'public.courses.index',
            'create' => 'public.courses.create',
            'store' => 'public.courses.store',
            'show' => 'public.courses.show',
            'edit' => 'public.courses.edit',
            'update' => 'public.courses.update',
            'destroy' => 'public.courses.destroy',
        ]);
    });


    // AI
    Route::prefix('publics')->group(function () {
        Route::resource('/ai', AiController::class)->names([
            'index' => 'public.ai.index',
            'create' => 'public.ai.create',
            'store' => 'public.ai.store',
            'show' => 'public.ai.show',
            'edit' => 'public.ai.edit',
            'update' => 'public.ai.update',
            'destroy' => 'public.ai.destroy',
        ]);
    });


    // About
    Route::prefix('publics')->group(function () {
        Route::resource('/about', AboutController::class)->names([
            'index' => 'public.about.index',
            'create' => 'public.about.create',
            'store' => 'public.about.store',
            'show' => 'public.about.show',
            'edit' => 'public.about.edit',
            'update' => 'public.about.update',
            'destroy' => 'public.about.destroy',
        ]);
    });


    // Services
    Route::prefix('publics')->group(function () {
        Route::resource('/services', ServicesController::class)->names([
            'index' => 'public.services.index',
            'create' => 'public.services.create',
            'store' => 'public.services.store',
            'show' => 'public.services.show',
            'edit' => 'public.services.edit',
            'update' => 'public.services.update',
            'destroy' => 'public.services.destroy',
        ]);
    });

    /**
     * BLOG MODULE PUBLIC
     * BlogPublicController
     */
    Route::prefix('publics')->group(function () {
        Route::resource('/blogs', BlogPublicController::class)->names([
            'index' => 'public.blogs.index',
            'create' => 'public.blogs.create',
            'store' => 'public.blogs.store',
            'show' => 'public.blogs.show',
            'edit' => 'public.blogs.edit',
            'update' => 'public.blogs.update',
            'destroy' => 'public.blogs.destroy',
        ]);
    });

    /**
     * BLOG MODULE PUBLIC  indexCategoryTag
     * BlogPublicController 
     */
    // Route::prefix('public-blog-category-home')->group(function () {
    //     Route::resource('/blogs', BlogPublicController::class)->names([
    //         'index' => 'public-blog-category-home.blogs.indexCategoryTag',
    //         'create' => 'public-blog-category-home.blogs.create',
    //         'store' => 'public-blog-category-home.blogs.store',
    //         'show' => 'public-blog-category-home.blogs.show',
    //         'edit' => 'public-blog-category-home.blogs.edit',
    //         'update' => 'public-blog-category-home.blogs.update',
    //         'destroy' => 'public-blog-category-home.blogs.destroy',
    //     ]);
    // });

    /**
     * BLOG MODULE PUBLIC  indexCategoryTagBlog
     * BlogPublicController 
     */
    // Route::prefix('public-blog-category')->group(function () {
        Route::resource('/category_blog', BlogPublicController::class)->names([
            'index' => 'public-blog-category.category_blog.indexCategoryTagBlog',
            'create' => 'public-blog-category.category_blog.create',
            'store' => 'public-blog-category.category_blog.store',
            'show' => 'public-blog-category.category_blog.show',
            'edit' => 'public-blog-category.category_blog.edit',
            'update' => 'public-blog-category.category_blog.update',
            'destroy' => 'public-blog-category.category_blog.destroy',
        ]);
    // });


    

    Route::prefix('publics')->group(function () {
        Route::resource('/contact', ContactController::class)->names([
            'index' => 'public.contact.index',
            'create' => 'public.contact.create',
            'store' => 'public.contact.store',
            'show' => 'public.contact.show',
            'edit' => 'public.contact.edit',
            'update' => 'public.contact.update',
            'destroy' => 'public.contact.destroy',
        ]);
    });



    ###############################     public routes   ends here  #######################

    /**
     * -------------------------------------------------
     * ---------------------Dashbord Controller-------------->
     * -------------------------------------------------
     */

    
    ################################################ DASHBOARD STARTS HERE #############################


    
    Route::get('/dashboard', [MainDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(['auth'])->group(function () {

        
    /**
     * Student Controller
     */
    Route::resource('/students', StudentController::class);

    /**
     * Classes Controller
     */
    Route::resource('/classes', ClassesController::class);

    /**
     * Subject Controller
     */
    Route::resource('/subjects', SubjectController::class);

    
    
    /**
     * StudentPromotion controller
     */
    Route::resource('/studdentpromotion', StudentPromotionController::class);
    Route::post('/find/promotion/students', [StudentPromotionController::class, 'find_promotion_students'])->name('findPromotion.students');



    /**
     * Role Controller
     */
    Route::prefix('dashboard')->group(function () {
    Route::resource('/roles', RoleController::class);
    Route::post('/attach/{role}', [RoleController::class, 'attachPermissions'])->name('permissions.attach');
    Route::DELETE('/role/{role}/permission/{permission}', [RoleController::class, 'revokPermissions'])->name('permissions.revok');
    });

    /**
     * Permission Controller
     */
    Route::prefix('dashboard')->group(function () {
    Route::resource('/permissions', PermissionController::class);
    Route::post('/attach/role/{permission}', [PermissionController::class, 'attachRole'])->name('role.attach');
    Route::DELETE('/permission/{permission}/role/{role}/', [PermissionController::class, 'revokRole'])->name('role.revok');
    });

    /**
     * User Controller
     */
    Route::prefix('dashboard')->group(function () {
    Route::get('/tutors', [UserController::class, 'tutors'])->name('tutors.tutors'); // only tutors
    Route::get('/student', [UserController::class, 'students'])->name('students.students');  // only students
    Route::get('/clients', [UserController::class, 'clients'])->name('clients.clients');  // only clients
    Route::post('/user/role/update/{user}', [UserController::class, 'userUpdateRole'])->name('userUpdate.role');
    });

    /**
     * User Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/users', UserController::class)->names([
            'index' => 'dashboard.users.index',
            // 'create' => 'dashboard.users.create',
            'store' => 'dashboard.users.store',
            // 'show' => 'dashboard.users.show',
            // 'edit' => 'dashboard.users.edit',
            'update' => 'dashboard.users.update',
            'destroy' => 'dashboard.users.destroy',
        ]);
    });


     /**
     * BLOG MODULE
     * Blog Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/blogs', BlogController::class)->names([
            'index' => 'dashboard.blogs.index',
            'create' => 'dashboard.blogs.create',
            'store' => 'dashboard.blogs.store',
            'show' => 'dashboard.blogs.show',
            'edit' => 'dashboard.blogs.edit',
            'update' => 'dashboard.blogs.update',
            'destroy' => 'dashboard.blogs.destroy',
        ]);
    });
    
    // Route::prefix('dashboard')->group(function () {
    //     Route::resource('/blogs', BlogController::class)->name('dashboard.blogs.index');
    //     Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('dashboard.blogs.show');
    //     Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('dashboard.blogs.edit');
    //     Route::patch('/blogs/{id}', [BlogController::class, 'update'])->name('dashboard.blogs.update');
    //     Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('dashboard.blogs.destroy');
    // });
    


    /**
     * Tags Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/tags', TagsController::class)->names([
            'index' => 'dashboard.tags.index',
            'create' => 'dashboard.tags.create',
            'store' => 'dashboard.tags.store',
            'show' => 'dashboard.tags.show',
            'edit' => 'dashboard.tags.edit',
            'update' => 'dashboard.tags.update',
            'destroy' => 'dashboard.tags.destroy',
        ]);
    });
    


    /**
     * BlogCategories Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/blog_categories', BlogCategoriesController::class)->names([
            'index' => 'dashboard.blog_categories.index',
            'create' => 'dashboard.blog_categories.create',
            'store' => 'dashboard.blog_categories.store',
            'show' => 'dashboard.blog_categories.show',
            'edit' => 'dashboard.blog_categories.edit',
            'update' => 'dashboard.blog_categories.update',
            'destroy' => 'dashboard.blog_categories.destroy',
        ]);
    });



    /**
     * COURSE MODULE
     * Course Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/courses', CourseController::class)->names([
            'index' => 'dashboard.courses.index',
            'create' => 'dashboard.courses.create',
            'store' => 'dashboard.courses.store',
            'show' => 'dashboard.courses.show',
            'edit' => 'dashboard.courses.edit',
            'update' => 'dashboard.courses.update',
            'destroy' => 'dashboard.courses.destroy',
        ]);
    });


    /**
     * CourseTypes Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/coursetypes', CourseTypeController::class)->names([
            'index' => 'dashboard.coursetypes.index',
            'create' => 'dashboard.coursetypes.create',
            'store' => 'dashboard.coursetypes.store',
            'show' => 'dashboard.coursetypes.show',
            'edit' => 'dashboard.coursetypes.edit',
            'update' => 'dashboard.coursetypes.update',
            'destroy' => 'dashboard.coursetypes.destroy',
        ]);
    });



    /**
     * CoursesCategories Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/course_categories', CourseCategoriesController::class)->names([
            'index' => 'dashboard.course_categories.index',
            'create' => 'dashboard.course_categories.create',
            'store' => 'dashboard.course_categories.store',
            'show' => 'dashboard.course_categories.show',
            'edit' => 'dashboard.course_categories.edit',
            'update' => 'dashboard.course_categories.update',
            'destroy' => 'dashboard.course_categories.destroy',
        ]);
    });



    /**
     * PROJECT MODULE
     * Project Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/projects', ProjectController::class)->names([
            'index' => 'dashboard.projects.index',
            'create' => 'dashboard.projects.create',
            'store' => 'dashboard.projects.store',
            'show' => 'dashboard.projects.show',
            'edit' => 'dashboard.projects.edit',
            'update' => 'dashboard.projects.update',
            'destroy' => 'dashboard.projects.destroy',
        ]);
    });



    /**
     * ProjectTypes Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/projecttypes', ProjectTypeController::class)->names([
            'index' => 'dashboard.projecttypes.index',
            'create' => 'dashboard.projecttypes.create',
            'store' => 'dashboard.projecttypes.store',
            'show' => 'dashboard.projecttypes.show',
            'edit' => 'dashboard.projecttypes.edit',
            'update' => 'dashboard.projecttypes.update',
            'destroy' => 'dashboard.projecttypes.destroy',
        ]);
    });


    /**
     * ProjectCategories Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/project_categories', ProjectCategoriesController::class)->names([
            'index' => 'dashboard.project_categories.index',
            'create' => 'dashboard.project_categories.create',
            'store' => 'dashboard.project_categories.store',
            'show' => 'dashboard.project_categories.show',
            'edit' => 'dashboard.project_categories.edit',
            'update' => 'dashboard.project_categories.update',
            'destroy' => 'dashboard.project_categories.destroy',
        ]);
    });


    /**
     * ProjectStatus Controller
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/project_status', ProjectStatusController::class)->names([
            'index' => 'dashboard.project_status.index',
            'create' => 'dashboard.project_status.create',
            'store' => 'dashboard.project_status.store',
            'show' => 'dashboard.project_status.show',
            'edit' => 'dashboard.project_status.edit',
            'update' => 'dashboard.project_status.update',
            'destroy' => 'dashboard.project_status.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * IconsController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/icons', IconsController::class)->names([
            'index' => 'dashboard.icons.index',
            'create' => 'dashboard.icons.create',
            'store' => 'dashboard.icons.store',
            'show' => 'dashboard.icons.show',
            'edit' => 'dashboard.icons.edit',
            'update' => 'dashboard.icons.update',
            'destroy' => 'dashboard.icons.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * ContactMessagingController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/contactus', ContactMessagingController::class)->names([
            'index' => 'dashboard.contactus.index',
            'create' => 'dashboard.contactus.create',
            'store' => 'dashboard.contactus.store',
            'show' => 'dashboard.contactus.show',
            'edit' => 'dashboard.contactus.edit',
            'update' => 'dashboard.contactus.update',
            'destroy' => 'dashboard.contactus.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * ContactInfoController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/contact_information', ContactInfoController::class)->names([
            'index' => 'dashboard.contact_information.index',
            'create' => 'dashboard.contact_information.create',
            'store' => 'dashboard.contact_information.store',
            'show' => 'dashboard.contact_information.show',
            'edit' => 'dashboard.contact_information.edit',
            'update' => 'dashboard.contact_information.update',
            'destroy' => 'dashboard.contact_information.destroy',
        ]);
    });

     /**
     * SYSTEM INFORMATION MODULE
     * SMController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/social_media', SMController::class)->names([
            'index' => 'dashboard.social_media.index',
            'create' => 'dashboard.social_media.create',
            'store' => 'dashboard.social_media.store',
            'show' => 'dashboard.social_media.show',
            'edit' => 'dashboard.social_media.edit',
            'update' => 'dashboard.social_media.update',
            'destroy' => 'dashboard.social_media.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * SystemAboutController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/aboutus', SystemAboutController::class)->names([
            'index' => 'dashboard.aboutus.index',
            'create' => 'dashboard.aboutus.create',
            'store' => 'dashboard.aboutus.store',
            'show' => 'dashboard.aboutus.show',
            'edit' => 'dashboard.aboutus.edit',
            'update' => 'dashboard.aboutus.update',
            'destroy' => 'dashboard.aboutus.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * SystemAIController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/ai', SystemAIController::class)->names([
            'index' => 'dashboard.ai.index',
            'create' => 'dashboard.ai.create',
            'store' => 'dashboard.ai.store',
            'show' => 'dashboard.ai.show',
            'edit' => 'dashboard.ai.edit',
            'update' => 'dashboard.ai.update',
            'destroy' => 'dashboard.ai.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * SystemPageHeaderController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/page_header', SystemPageHeaderController::class)->names([
            'index' => 'dashboard.page_header.index',
            'create' => 'dashboard.page_header.create',
            'store' => 'dashboard.page_header.store',
            'show' => 'dashboard.page_header.show',
            'edit' => 'dashboard.page_header.edit',
            'update' => 'dashboard.page_header.update',
            'destroy' => 'dashboard.page_header.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * SystemPartnersController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/partners', SystemPartnersController::class)->names([
            'index' => 'dashboard.partners.index',
            'create' => 'dashboard.partners.create',
            'store' => 'dashboard.partners.store',
            'show' => 'dashboard.partners.show',
            'edit' => 'dashboard.partners.edit',
            'update' => 'dashboard.partners.update',
            'destroy' => 'dashboard.partners.destroy',
        ]);
    });


     /**
     * SYSTEM INFORMATION MODULE
     * SystemServicesController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/services', SystemServicesController::class)->names([
            'index' => 'dashboard.services.index',
            'create' => 'dashboard.services.create',
            'store' => 'dashboard.services.store',
            'show' => 'dashboard.services.show',
            'edit' => 'dashboard.services.edit',
            'update' => 'dashboard.services.update',
            'destroy' => 'dashboard.services.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * SystemSliderController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/sliders', SystemSliderController::class)->names([
            'index' => 'dashboard.sliders.index',
            'create' => 'dashboard.sliders.create',
            'store' => 'dashboard.sliders.store',
            'show' => 'dashboard.sliders.show',
            'edit' => 'dashboard.sliders.edit',
            'update' => 'dashboard.sliders.update',
            'destroy' => 'dashboard.sliders.destroy',
        ]);
    });


    /**
     * SYSTEM INFORMATION MODULE
     * SystemTestimonialsController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/testimonials', SystemTestimonialsController::class)->names([
            'index' => 'dashboard.testimonials.index',
            'create' => 'dashboard.testimonials.create',
            'store' => 'dashboard.testimonials.store',
            'show' => 'dashboard.testimonials.show',
            'edit' => 'dashboard.testimonials.edit',
            'update' => 'dashboard.testimonials.update',
            'destroy' => 'dashboard.testimonials.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * SystemTitleLogoController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/title_logo', SystemTitleLogoController::class)->names([
            'index' => 'dashboard.title_logo.index',
            'create' => 'dashboard.title_logo.create',
            'store' => 'dashboard.title_logo.store',
            'show' => 'dashboard.title_logo.show',
            'edit' => 'dashboard.title_logo.edit',
            'update' => 'dashboard.title_logo.update',
            'destroy' => 'dashboard.title_logo.destroy',
        ]);
    });

    /**
     * SYSTEM INFORMATION MODULE
     * EmailInfoController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/email_information', EmailInfoController::class)->names([
            'index' => 'dashboard.email_information.index',
            'create' => 'dashboard.email_information.create',
            'store' => 'dashboard.email_information.store',
            'show' => 'dashboard.email_information.show',
            'edit' => 'dashboard.email_information.edit',
            'update' => 'dashboard.email_information.update',
            'destroy' => 'dashboard.email_information.destroy',
        ]);
    });


    /**
     * SYSTEM INFORMATION MODULE
     * AddressInfoController
     */
    Route::prefix('dashboard')->group(function () {
        Route::resource('/address_information', AddressInfoController::class)->names([
            'index' => 'dashboard.address_information.index',
            'create' => 'dashboard.address_information.create',
            'store' => 'dashboard.address_information.store',
            'show' => 'dashboard.address_information.show',
            'edit' => 'dashboard.address_information.edit',
            'update' => 'dashboard.address_information.update',
            'destroy' => 'dashboard.address_information.destroy',
        ]);
    });



################################################ DASHBOARD ENDS HERE #############################

});

require __DIR__.'/auth.php';
