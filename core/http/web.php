<?php

use core\Route;

$app_name = getenv("APP_NAME");

// Routes for the auth controller
Route::post("/$app_name/", "controller\AuthController@index");
Route::post("/$app_name/auth/register/", "controller\AuthController@render_register_view");
Route::post("/$app_name/auth/login/", "controller\AuthController@index");
Route::post("/$app_name/auth/create-profile/", "controller\AuthController@render_create_profile_view");
Route::post("/$app_name/auth/login/sign-in/", "controller\AuthController@sign_in_user");
Route::post("/$app_name/auth/create-account/", "controller\AuthController@create_account");
Route::post("/$app_name/image-upload/", "controller\AuthController@upload_photo");
Route::post("/$app_name/auth/check-nin/", "controller\AuthController@check_nin");
Route::post("/$app_name/auth/check-email/", "controller\AuthController@check_email");
Route::post("/$app_name/auth/check-password/", "controller\AuthController@check_password");
Route::post("/$app_name/auth/change-password/", "controller\AuthController@change_password");
Route::post("/$app_name/auth/save-profile/", "controller\AuthController@save_profile");
Route::post("/$app_name/auth/update-profile/", "controller\AuthController@update_profile");
Route::post("/$app_name/auth/user/profile/update-photo/", "controller\AuthController@update_photo");
Route::post("/$app_name/auth/sign-out/", "controller\AuthController@sign_out");
Route::post("/$app_name/auth/user/profile/", "controller\AuthController@render_show_profile_view");
Route::post("/$app_name/auth/users/", "controller\AuthController@get_system_users");
Route::post("/$app_name/auth/users/get-user-details/", "controller\AuthController@get_user_details");


//Routes for PageController
Route::post("/$app_name/page-not-found/", "controller\PageController@render_404");
Route::post("/$app_name/dashboard/", "controller\PageController@render_dashboard");
Route::post("/$app_name/dashboard/participant/register/", "controller\PageController@render_register_participant");
Route::post("/$app_name/dashboard/participant/progress/add", "controller\PageController@render_add_progress");
Route::post("/$app_name/dashboard/lessons/", "controller\PageController@render_lessons");
Route::post("/$app_name/dashboard/events/", "controller\PageController@render_events");
Route::post("/$app_name/dashboard/education-materials/", "controller\PageController@render_materials");
Route::post("/$app_name/dashboard/participants/progress/", "controller\PageController@render_participants_progress");
Route::post("/$app_name/dashboard/reports/", "controller\PageController@render_reports");
Route::post("/$app_name/dashboard/participant/progress/view-encounters", "controller\PageController@render_view_encounters");

//Routes for MainController
Route::post("/$app_name/participants/create", "controller\MainController@create_participant");
Route::post("/$app_name/participants/update", "controller\MainController@update_participant");
Route::post("/$app_name/participants/unenroll", "controller\MainController@unenroll_participant");
Route::post("/$app_name/lessons/create", "controller\MainController@create_lesson");
Route::post("/$app_name/lessons/update", "controller\MainController@update_lesson");
Route::post("/$app_name/events/create", "controller\MainController@create_event");
Route::post("/$app_name/events/update", "controller\MainController@update_event");
Route::post("/$app_name/materials/create", "controller\MainController@create_material");
Route::post("/$app_name/participants/progress/add", "controller\MainController@create_progress_row");
Route::post("/$app_name/encounters/create", "controller\MainController@create_encounter");

//Routes for Reports Controller
Route::post("/$app_name/reports/export/progress/all", "controller\ReportsController@export_all_progress_as_excel");

?>
