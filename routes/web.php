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



/*Route für AppControler*/
Route::get('topics/get/{id}', 'AppController@getDynamicTopics'); //Route zu dynamic dropdown Subjects/Topics
Route::get('contents/get/{id}', 'AppController@getDynamicContents'); //Route zu dynamic dropdown Topics/Contents


/*Route für Mails*/
Route::get('/mailable', 'AppController@sendBrokenLinks');

/*Routes for Teachers*/
Route::get('/lehrer', 'TeacherController@index');
Route::get ('/lehrer/coaching', 'TeacherController@coaching');
Route::get ('/lehrer/schulcoaching', 'TeacherController@schulcoaching');

/*Routes for Search*/
Route::get('/suche', 'SearchController@index');
Route::get('/suche/contents/{query}', 'SearchController@searchContents');
Route::get('/suche/units/{query}', 'SearchController@searchUnits');
Route::get('/suche/topics/{query}', 'SearchController@searchTopics');
Route::get('/suche/series/{query}', 'SearchController@searchSeries');



/*Routes for Units*/
Route::get('lehrer/unterrichtseinheiten' , 'Unitcontroller@index')->name('teacher.units');
Route::get('lehrer/toolbox/neu' , 'UnitController@create');
Route::post('lehrer/toolbox/speichern' , 'UnitController@store')->name('unit.store');
Route::get('lehrer/toolbox/{unit}' , 'UnitController@show');
Route::get('lehrer/toolbox/update/{unit}' , 'UnitController@edit')->name('unit.edit');
Route::delete('lehrer/toolbox/{unit}','UnitController@destroy')->name('units.destroy');
Route::patch('lehrer/toolbox/update/{unit}','UnitController@update')->name('units.update');
Route::get('lehrer/logout','Auth\LoginController@userLogout');
Route::get('lehrer/units','TeacherController@allunits');


/*Routes for Blocks*/
Route::post('lehrer/toolbox/aufgabe/speichern' , 'BlockController@store')->name('blocks.store');
Route::patch('lehrer/toolbox/update/{block}' , 'BlockController@store_content')->name('blocks.store_content');
Route::patch('lehrer/toolbox/update/{unit}' , 'BlockController@update')->name('blocks.update');
Route::delete('lehrer/toolbox/aufgabe/löschen/{task}', 'BlockController@destroy')->name('blocks.destroy');

/*Routes for Inquiries*/
Route::post('lehrer/anfrage' , 'InquiryController@store')->name('inquiries.store');

/* Homepage */
Route::get('/', 'VischoolController@index')->name('vischool');
Route::get('/test', function() {
});

/* Impressum */
Route::get('/impressum', function () {
    return view('legal.impressum');
});

/* Routes to Frontend */
Route::get('/subjects', 'VischoolController@subjects_index');
Route::get('/subjects/{id}', 'VischoolController@subject_show')->name('frontend.subject');
Route::get('/topics', 'VischoolController@topics_index');
Route::get('/topic/{topic}', 'VischoolController@topic_show')->name('frontend.topic');
Route::get('/contents', 'VischoolController@contents_index');
Route::get('/content/{content}', 'VischoolController@content_show')->name('frontend.contents.show');
Route::get('/units', 'VischoolController@units_index');
Route::get('/unit', 'VischoolController@unit_show');
Route::get('/unit/{unit}/{diff}', 'VischoolController@unit_diff')->name('units.filterdiffs');
Route::get('/lerneinheiten/{topic}', 'VischoolController@units_topic');
Route::get('/lerneinheit/{unit}', 'VischoolController@unit_show');


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


/*Routes for subjects database*/
Route::get('/backend/subjects', 'SubjectsController@index');
Route::get('/backend/subjects/create', 'SubjectsController@create');
Route::post('/backend/subjects', 'SubjectsController@store');
Route::get('/backend/subjects/{subject}', 'SubjectsController@show');
Route::delete('/backend/subjects/{subject}','SubjectsController@destroy')->name('subjects.destroy');
Route::patch('/backend/subjects/{subject}','SubjectsController@update')->name('subjects.update');

/*Routes for topics database*/
Route::get('/backend/topics', 'TopicController@index');
Route::get('/backend/topics/create', 'TopicController@create');
Route::post('/backend/topics', 'TopicController@store');
Route::get('/backend/topics/{topic}', 'TopicController@show');
Route::delete('/backend/topics/{topic}','TopicController@destroy')->name('topics.destroy');
Route::patch('/backend/topics/{topic}','TopicController@update')->name('topics.update');

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

/*Routes for tags database*/
Route::get('/backend/tags', 'TagController@index');
Route::get('/backend/tags/{tag}', 'TagController@show');
Route::post('/backend/tags', 'TagController@store');
Route::delete('/backend/tags/{tag}','TagController@destroy')->name('tags.destroy');

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



/*Routes for User Authentication*/
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store')->name('register.store');

Route::get('/login', 'SessionsController@create');
Route::get('/logout', 'SessionsController@destroy');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
