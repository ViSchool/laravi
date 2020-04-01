 <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/*Route für AppController*/
Route::get('topics/get/{id}', 'AppController@getDynamicTopics'); //Route zu dynamic dropdown Subjects/Topics
Route::get('contents/get/{id}', 'AppController@getDynamicContents'); //Route zu dynamic dropdown Topics/Contents
Route::get('tools/get/{id}', 'AppController@getDynamicTools'); //Route zu dynamic placeholder link 
Route::get('chosencontent/get/{id}', 'AppController@getChosenContent'); //Route zu chosen Content
Route::get('chooseContent/{unit}/{id}', 'AppController@chooseContent'); 
Route::get('/differentiations/getgroupdiff/{differentiation_group}/{teacherId}', 'AppController@getdifferentiations');
Route::get('/removeContentfromSession', 'AppController@removeContentfromSession');

/*Route für Mails*/
Route::get('/mailable', 'AppController@sendBrokenLinks');

/*Routes for Teachers*/
/*Routes for Units*/

/*Routes for Schools*/
// Route::get('/{schule}', 'SchoolController@school_page');


/*Routes for Lehrer Logout and profile*/
Route::patch('/lehrer/{id}/passwortaendern','RegistrationController@change_password')->name('teacher.change_password');
Route::get('lehrer/logout','Auth\LoginController@userLogout');
Route::get('lehrer/lehrerkonto','TeacherController@lehrerkonto');

//Routen, damit Lehrer selbst Themen einstellen kann und Statusänderungen dazu
Route::get('lehrer/themen','TeacherController@topics');
Route::post('lehrer/themen/speichern','TopicController@teacher_store');
Route::post('lehrer/themen/bearbeiten/{topic}','TopicController@teacher_update');
Route::get('lehrer/newTopicPrivate/{topic}','TopicController@teacherTopicPrivate');
Route::get('lehrer/newTopicViSchool/{topic}','TopicController@teacherTopicViSchool');
Route::delete('lehrer/newTopicDelete/{topic}','TopicController@destroy');
 
//Routen, damit Lehrer selbst Inhalte einstellen kann und Statusänderungen dazu
Route::get('/lehrer/inhalte','TeacherController@contents')->name('teacher.contents');
Route::post('/lehrer/inhalte','ContentController@teacher_store');
Route::patch('/lehrer/inhalte/{content}','ContentController@teacher_update');
Route::get('/lehrer/newContentPrivate/{content}','ContentController@teacherContentPrivate');
Route::get('/lehrer/newContentViSchool/{content}','ContentController@teacherContentViSchool');
Route::get('/lehrer/newContentDelete/{content}','ContentController@destroy');

//Routen damit Lehrer selbst Serien anlegen können
Route::get('lehrer/serien','SerieController@index');
Route::post('lehrer/serien','SerieController@teacher_store');

 
//Routes for units and blocks, damit Lehrer selbst lerneinheiten und Aufgaben einstellen kann und Statusänderungen dazu
Route::get('/lehrer/lerneinheiten','TeacherController@units')->name('teacher.units');
Route::get('/lehrer/lerneinheiten/erstellen','TeacherController@create_unit');
Route::post('/lehrer/lerneinheiten','UnitController@teacher_store');
Route::get('/lehrer/lerneinheiten/bearbeiten/{unit}', 'UnitController@teacher_edit');
Route::patch('/lehrer/lerneinheiten/bearbeiten/{unit}','UnitController@teacher_update');
Route::get('/lehrer/newUnitPrivate/{unit}','UnitController@teacherUnitPrivate');
Route::get('/lehrer/newUnitViSchool/{unit}','UnitController@teacherUnitViSchool');
Route::delete('/lehrer/newUnitDelete/{unit}','UnitController@destroy');
Route::get('/lehrer/lerneinheiten/{unit}/aufgabe','TeacherController@create_block')->name('teacher.block.create');
Route::get('/lehrer/lerneinheiten/{unit}/serie/{serie}','UnitController@save_unit_serie')->name('teacher.unit_serie.save');
Route::get('/lehrer/lerneinheiten/{unit}/keineSerie','UnitController@save_unit_serieNull')->name('teacher.unit_serie.null');
Route::post('/lehrer/lerneinheiten/serie/erstellen', 'SerieController@teacher_store')->name('teacher.serie.create');
Route::post('/lehrer/lerneinheiten/aufgabe','BlockController@teacher_store');
Route::get('/lehrer/lerneinheiten/{unit}/aufgaben','BlockController@teacher_show')->name('teacher.unit.block');
Route::get('/lehrer/lerneinheiten/aufgabe/bearbeiten/{block}','BlockController@teacher_edit');
Route::patch('/lehrer/lerneinheiten/aufgabe/bearbeiten/{block}','BlockController@teacher_update');
Route::delete('/lehrer/lerneinheiten/aufgabe/löschen/{block}','BlockController@teacher_destroy');
Route::get('/lehrer/{user}/copy/{unit}','UnitController@copy')->name('unit.copy');
Route::get('/lehrer/units','TeacherController@allunits');

/*Routes for Differentiations*/
Route::get('/lehrer/{user}/lernniveaus/übersicht','DifferentiationController@index');
Route::post('/lehrer/{user}/lernniveaus/erstellen','DifferentiationController@store');
Route::post('/lehrer/{user}/lernniveaus/bearbeiten','DifferentiationController@update');
Route::delete('/lehrer/{user}/lernniveaus/löschen/{differentiation_group}','DifferentiationController@destroy');
Route::get('/lehrer/profile/diffOn/{user}','DifferentiationController@diffSwitchOn');
Route::get('/lehrer/profile/diffOff/{user}','DifferentiationController@diffSwitchOff');

/*Routes for Inquiries*/
Route::post('/lehrer/anfrage', 'InquiryController@store')->name('inquiries.store');
Route::get('/lehrer/register_soon','InquiryController@index')->name('inquiries.index');

/*Schüler- und Klassenaccounts */

Route::post('lehrer/schueleraccount/erstellen','StudentController@store');
Route::post('lehrer/klassenaccount/erstellen','StudentController@store_classaccount');
Route::post('lehrer/schueleraccount_liste/erstellen','StudentgroupController@store');
Route::delete('/lehrer/schueleraccount/loeschen/{id}', 'StudentController@destroy');
Route::delete('/lehrer/klassenaccount/loeschen/{id}', 'StudentController@destroy');
Route::get('/lehrer/klassenaccounts','TeacherController@classes');
Route::get('/lehrer/schueleraccounts','TeacherController@students')->name('schueleraccounts');
Route::get('/lehrer/schuelergruppe/schueleraccounts_erstellen/{id}', 'StudentController@store_group')->name('store_studentgroup');
Route::delete('/lehrer/schuelergruppe/löschen/{id}', 'StudentgroupController@destroy')->name('studentgroup_delete');
//nur zu Testzwecken:
Route::get('/lehrer/schuelergruppe/pdf/{id}','StudentgroupController@show')->name('show_studentgroup_pdf');

Route::get ('/lehrer/faq', 'TeacherController@faq');
Route::get ('/lehrer/verified', 'TeacherController@verified');
Route::get ('/lehrer/coaching', 'TeacherController@coaching');
Route::get ('/lehrer/schulcoaching', 'TeacherController@schulcoaching');
Route::get ('/lehrer/danke', 'TeacherController@thanks');
Route::get('/lehrer', 'TeacherController@index');

Route::get('/backend/teacher', 'TeacherController@indexBackend')->name('backend.teacher.index');
Route::get('/backend/teacher/{teacher}', 'TeacherController@showBackend')->name('backend.teacher.show');

/*Routes for Search*/
Route::get('/suche', 'SearchController@index');
Route::get('/suche/contents/{query}', 'SearchController@searchContents');
Route::get('/suche/units/{query}', 'SearchController@searchUnits');
Route::get('/suche/topics/{query}', 'SearchController@searchTopics');
Route::get('/suche/series/{query}', 'SearchController@searchSeries');




/*SchülerLogin*/

Route::post('/schueler/login','Auth\StudentLoginController@login')->name('students.login.submit');
Route::get('/schueler/logout','Auth\StudentLoginController@studentLogout')->name('students.logout');


/* Homepage */
Route::get('/', 'VischoolController@index')->name('vischool');
Route::get('/test', function() {
});

/* Legal Stuff */
Route::get('/impressum', function () {
    return view('legal.impressum');
});
Route::get('/datenschutz', function () {
    return view('legal.datenschutz');
});

/* Routes to Frontend */
/*NICHT BENUTZT: Route::get('/subjects', 'VischoolController@subjects_index');*/
Route::get('/subjects/{id}', 'VischoolController@subject_show')->name('frontend.subject');
/*NICHT BENUTZT: Route::get('/topics', 'VischoolController@topics_index');*/
Route::get('/topic/{topic}', 'VischoolController@topic_show')->name('frontend.topic');
Route::get('/contents', 'VischoolController@contents_index');
Route::get('/content/{content}', 'VischoolController@content_show')->name('frontend.contents.show');
/*NICHT BENUTZT: Route::get('/units', 'VischoolController@units_index')->name('frontend.units.index');*/
Route::get('/unit', 'VischoolController@unit_show');
Route::get('/unit/{unit}/{diff}', 'VischoolController@unit_diff')->name('units.filterdiffs');
Route::get('/lerneinheiten/{topic}', 'VischoolController@units_topic');
Route::get('/lerneinheit/{unit}', 'VischoolController@unit_show');
Route::get('/lerneinheiten/serie/{serie}', 'VischoolController@units_serie');

Route::get('/portalnavigator', 'PortalController@index_frontend');
Route::post('/portalnavigator/filter','PortalController@index_frontend_filtered');

/*Routes to Backend*/

// Authentication Admins
Route::prefix('backend')->group(function() {
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');
Route::post('/password/email' , 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/password/reset' , 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/password/reset' , 'Auth\AdminResetPasswordController@reset');
Route::get('/password/reset/{token}' , 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
Route::get('/freigaben', 'BackendController@approvals')->name('admin.approvals');
Route::get('/', 'BackendController@index')->name('admin.dashboard');

});



/*Routes for Blog */
Route::get('/backend/blog', 'PostController@index')->name('backend.blog.index');
Route::get('/backend/blog/create', 'PostController@create');
Route::post('/backend/blog', 'PostController@store');
Route::get('/backend/blog/{post}', 'PostController@show');
Route::get('/blog' , 'PostController@index_frontend')->name('blog.index');
Route::get('/blog/tag/{tag}' , 'PostController@tag_frontend')->name('blog.tag');
Route::get('/blog/{post}' , 'PostController@show_frontend')->name('blog.show');
Route::delete('backend/blog/{post}','PostController@destroy')->name('posts.destroy');
Route::patch('backend/blog/{post}','PostController@update')->name('posts.update');

/*Routes for FAQs */
Route::get('/backend/faq', 'FaqController@index')->name('backend.faq.index');
Route::get('/backend/faq/create', 'FaqController@create')->name('backend.faq.create');
Route::post('/backend/faq', 'FaqController@store')->name('backend.faq.store');
Route::get('/backend/faq/{faq}', 'FaqController@show')->name('backend.faq.show');
Route::delete('backend/faq/{faq}','FaqController@destroy')->name('backend.faq.destroy');
Route::patch('backend/faq/{faq}','FaqController@update')->name('backend.faq.update');


/*Routes for Permissions */
Route::get('/backend/permission', 'PermissionController@index')->name('backend.permission.index');
Route::get('/backend/permission/create', 'PermissionController@create');
Route::post('/backend/permission', 'PermissionController@store');
Route::get('/backend/permission/{permission}', 'PermissionController@show');
Route::delete('backend/permission/{post}','PermissionController@destroy')->name('posts.destroy');
Route::patch('backend/permission/{post}','PermissionController@update')->name('posts.update');

/*Routes for subjects database*/
Route::get('/backend/subjects', 'SubjectsController@index');
Route::get('/backend/subjects/create', 'SubjectsController@create');
Route::post('/backend/subjects', 'SubjectsController@store');
Route::get('/backend/subjects/{subject}', 'SubjectsController@show');
Route::delete('/backend/subjects/{subject}','SubjectsController@destroy')->name('subjects.destroy');
Route::patch('/backend/subjects/{subject}','SubjectsController@update')->name('subjects.update');

/*Routes for schools database*/
Route::get('/backend/schools', 'SchoolController@index');
Route::get('/backend/schools/create', 'SchoolController@create');
Route::post('/backend/schools', 'SchoolController@store');
Route::get('/backend/schools/{school}', 'SchoolController@show');
Route::delete('/backend/schools/{school}','SchoolController@destroy')->name('schools.destroy');
Route::patch('/backend/schools/{school}','SchoolController@update')->name('schools.update');

/*Routes for topics database*/
Route::get('/backend/topics', 'TopicController@index');
Route::get('/backend/topics/create', 'TopicController@create');
Route::post('/backend/topics', 'TopicController@store');
Route::get('/backend/topics/{topic}', 'TopicController@show');
Route::delete('/backend/topics/{topic}','TopicController@destroy')->name('topics.destroy');
Route::patch('/backend/topics/{topic}','TopicController@update')->name('topics.update');
Route::get('backend/topics/approve/{topic}','TopicController@teacherTopicApprove');



/*Routes for contents database*/
Route::get('/backend/contents', 'ContentController@index')->name('backend.contents');
Route::get('/backend/contents/subjectfilter/{subject}', 'ContentController@index_subject')->name('backend.contents.filtersubjects');
Route::get('/backend/contents/topicfilter/{subject}_{topic}', 'ContentController@index_topic')->name('backend.contents.filtertopics');
Route::get('/backend/contents/create', 'ContentController@create');
Route::get('/backend/contents/create/ajax-state','ContentController@create_ddd');
Route::post('/backend/contents', 'ContentController@store');
Route::get('/backend/contents/{content}', 'ContentController@show')->name('backend.contents.show');
Route::delete('/backend/contents/{content}','ContentController@destroy')->name('contents.destroy');
Route::patch('/backend/contents/{content}','ContentController@update')->name('contents.update');
Route::get('/backend/contents/adminapproval/{content}','ContentController@teacherContentApprove')->name('contents.adminapproval');


/*Routes for tags database*/
Route::get('/backend/tags', 'TagController@index');
Route::get('/backend/tags/{tag}', 'TagController@show');
Route::post('/backend/tags', 'TagController@store');
Route::patch('/backend/tags/{tag}', 'TagController@update');
Route::delete('/backend/tags/{tag}','TagController@destroy')->name('tags.destroy');

/*Routes for features database*/
Route::get('/backend/featured', 'FeatureController@index');
Route::post('/backend/featured', 'FeatureController@store');
Route::post('/backend/featured_off', 'FeatureController@destroy');


/*Routes for permissions database*/
Route::get('/backend/permissions', 'PermissionController@index');
Route::get('/backend/permissions/{permission}', 'PermissionController@show');
Route::post('/backend/permissions', 'PermissionController@store')->name('permissions.store');
Route::delete('/backend/permissions/{permission}','PermissionController@destroy')->name('permissions.destroy');
Route::patch('/backend/permissions','PermissionController@update')->name('permissions.update');

/*Routes for reviews database*/
Route::get('/reviews/{content}', 'ReviewController@index');
Route::post('/reviews', 'ReviewController@store')->name('review.store');


/*Routes for mistakes database*/
Route::get('/mistakes/{content}', 'ReviewController@index');
Route::post('/mistakes', 'MistakeController@store')->name('mistake.store');

/*Routes for series database*/
Route::get('/backend/series', 'SerieController@index')->name('backend.series.index');
Route::get('/backend/series/create', 'SerieController@create');
Route::post('/backend/series', 'SerieController@store');
Route::get('/backend/series/{serie}', 'SerieController@show');
Route::delete('/backend/series/{serie}','SerieController@destroy')->name('series.destroy');
Route::patch('/backend/series/{serie}','SerieController@update')->name('series.update');
Route::get('/backend/series/approve/{serie}','SerieController@teacherSerieApprove');

/*Routes for tools database*/
Route::get('/backend/tools', 'ToolController@index')->name('backend.tools.index');
Route::get('/backend/tools/create', 'ToolController@create')->name('backend.tools.create');
Route::get('/backend/tools/{tool}', 'ToolController@show')->name('backend.tools.show');
Route::post('/backend/tools', 'ToolController@store')->name('backend.tools.store');
Route::delete('/backend/tools/{tool}','ToolController@destroy')->name('tools.destroy');
Route::patch('/backend/tools/{tool}','ToolController@update')->name('tools.update');

/*Routes for portals database*/
Route::get('/backend/portals', 'PortalController@index')->name('backend.portals.index');
Route::get('/backend/portals/create', 'PortalController@create')->name('backend.portals.create');
Route::get('/backend/portals/{portal}', 'PortalController@show')->name('backend.portals.show');
Route::post('/backend/portals', 'PortalController@store')->name('backend.portals.store');
Route::delete('/backend/portals/{portal}','PortalController@destroy')->name('backend.portals.destroy');
Route::patch('/backend/portals/{portal}','PortalController@update')->name('portals.update');

/*Routes for units database backend*/
Route::get('/backend/units', 'UnitBackendController@index')->name('backend.units.index');
Route::get('/backend/units/subjectfilter/{subject}', 'UnitBackendController@index_subject')->name('backend.units.filtersubjects');
Route::get('/backend/units/topicfilter/{subject}_{topic}', 'UnitBackendController@index_topic')->name('backend.units.filtertopics');
Route::get('/backend/units/create', 'UnitBackendController@create')->name('backend.units.create');
Route::get('/backend/units/{unit}', 'UnitBackendController@show')->name('backend.units.show');
Route::post('/backend/units', 'UnitBackendController@store')->name('backend.units.store');
Route::delete('/backend/units/{unit}','UnitBackendController@destroy')->name('backend.units.destroy');
Route::patch('/backend/units/{unit}','UnitBackendController@update')->name('backend.units.update');
Route::get('/backend/units/approve/{unit}','UnitBackendController@teacherUnitApprove');

/*Routes for block database backend*/
Route::get('/backend/blocks/{unit}/create1', 'BlockBackendController@create_step1')->name('backend.blocks.create_step1');
Route::get('/backend/blocks/create2/{block}', 'BlockBackendController@create_step2')->name('backend.blocks.create_step2');
Route::get('/backend/blocks/create3/{block}', 'BlockBackendController@create_step3')->name('backend.blocks.create_step3');
Route::get('/backend/blocks/create4/{block}', 'BlockBackendController@create_step4')->name('backend.blocks.create_step4');

Route::get('/backend/blocks/{block}', 'BlockBackendController@show')->name('backend.blocks.show');
Route::post('/backend/blocks', 'BlockBackendController@store')->name('backend.blocks.store');
Route::delete('/backend/blocks/{block}','BlockBackendController@destroy')->name('backend.blocks.destroy');
Route::patch('/backend/blocks/{block}','BlockBackendController@update')->name('backend.blocks.update');
Route::patch('/backend/blocks/{block}/contents','BlockBackendController@update_contents')->name('backend.blocks.update_contents');
Route::patch('/backend/blocks/{block}/differentiation','BlockBackendController@update_differentiation')->name('backend.blocks.update_differentiation');
Route::patch('/backend/blocks/{block}/tipp','BlockBackendController@update_tipp')->name('backend.blocks.update_tipp');
Route::patch('/backend/blocks/{block}/orderup','BlockBackendController@update_orderup')->name('backend.blocks.update_orderup');
Route::patch('/backend/blocks/{block}/orderdown','BlockBackendController@update_orderdown')->name('backend.blocks.update_orderdown');

/*Routes for questions database*/
Route::get('/backend/questions/{content}', 'QuestionController@index')->name('backend.questions.index');
Route::get('/backend/questions/create/{content}', 'QuestionController@create')->name('backend.questions.create');
Route::get('/backend/questions/show/{question}', 'QuestionController@show')->name('backend.questions.show');
Route::post('/backend/questions', 'QuestionController@store')->name('backend.questions.store');
Route::delete('/backend/questions/{question}','QuestionController@destroy')->name('questions.destroy');
Route::patch('/backend/questions/{question}','QuestionController@update')->name('questions.update');



/*Routes for User Authentication
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store')->name('register.store');

Route::get('/login', 'SessionsController@create');
Route::get('/logout', 'SessionsController@destroy');
*/


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\RegisterController@register')->name('register');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Email Verification Routes
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice'); 
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify'); 
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('/home', 'ViSchoolControll@index')->name('home');
