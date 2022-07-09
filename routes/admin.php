<?php


$icon = RAVAND_URL . "/assets/svg/admin-menu-icon.svg";

add_menu_page(
    __("Ravand Admin Panel", "ravand"),
    __("Ravand", "ravand"),
    "manage_options",
    "ravand",
    Router::makeCallback(ControlPanelController::class, "view", [
        // Additional Middlewares
    ], "control-panel"),
    $icon,
    55
);

Admin::admin("ravand", function () {

});

AdminRouter::title("Something")
    ->menu("Something In Menu")
    ->icon()
    ->admin("something", function () {

    });

AdminRouter::get("sadasd")->title()->menu()->icon();

AdminRouter::get('/greeting', function () {
    return 'Hello World';
});

AdminRouter::get('/user', [UserController::class, 'index']);

AdminRouter::get($uri, $callback);
AdminRouter::post($uri, $callback);
AdminRouter::put($uri, $callback);
AdminRouter::patch($uri, $callback);
AdminRouter::delete($uri, $callback);
AdminRouter::options($uri, $callback);

AdminRouter::match(['get', 'post'], '/', function () {
    //
});
 
AdminRouter::any('/', function () {
    //
});


AdminRouter::redirect('/here', '/there', 301);

AdminRouter::view('/welcome', 'welcome', ['name' => 'Taylor']);

AdminRouter::get('/posts/{post}/comments/{comment}', function (Request $request,$postId, $commentId) {
    // {name?}
})->where('name', '[A-Za-z]+')
->name('profile');
//whereNumber, whereAlpha, ...
//->where('search', '.*');


AdminRouter::get(
    '/user/profile',
    [UserProfileController::class, 'show']
);

AdminRouter::middleware(['first', 'second'])->group(function () {
    AdminRouter::get('/', function () {
        // Uses first & second middleware...
    });
 
    AdminRouter::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});

AdminRouter::controller(AdminRouter::class)->group(function () {
    AdminRouter::get('/orders/{id}', 'show');
    AdminRouter::post('/orders', 'store');
});

AdminRouter::prefix('admin')->group(function () {
    AdminRouter::get('/users', function () {
        // Matches The "/admin/users" URL
    });
});

AdminRouter::name('admin.')->group(function () {
    AdminRouter::get('/users', function () {
        // Route assigned name "admin.users"...
    })->name('users');
});

//implicit shit
AdminRouter::get('/users/{user}', function (User $user) {
    return $user->email;
})->withTrashed();
// ->scopeBindings();
// ->missing(function (Request $request) {
//     return Redirect::route('locations.index');
// });

// explicit shit
AdminRouter::model('user', User::class);

AdminRouter::get('/posts/{post:slug}', function (Post $post) {
    return $post;
});

AdminRouter::bind('user', function ($value) {
    return User::where('name', $value)->firstOrFail();
});

// public function resolveRouteBinding($value, $field = null)
// {
//     return $this->where('name', $value)->firstOrFail();
// }

AdminRouter::pattern('id', '[0-9]+'); //boot

// AdminRouter::fallback(function () {
//     //
// });

// use wp nonces

/* AdminRouter::newPost("post-type");
 * AdminRouter::admin("post-type");
 * .
 * .
 * .
*/

// public function handle($request, Closure $next)
// {
//     if ($request->route()->named('profile')) {
//         //
//     }
 
//     return $next($request);
// }