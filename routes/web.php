<?php

Route::get('/', function () {
      return redirect()->route('dashboard');
});

Route::get('/dashboard','Admin\DashboardController@dashboard')->name('dashboard')->middleware('auth');
Auth::routes([
    'register'=> false

]);

Route::group(['prefix'=>'dashboard','namespace'=>'Admin','middleware' => ['auth']], function() {
   
    Route::get('users','UserController@index')->name('users.index');
    Route::get('users/create','UserController@create')->name('users.create');
    Route::post('users','UserController@store')->name('users.store');
    Route::get('users/{user}/edit','UserController@edit')->name('users.edit');
    Route::put('users/{user}','UserController@update')->name('users.update');
    Route::delete('users/{user}','UserController@destroy')->name('users.destroy');


    Route::get('users/profile/{id}','ProfileController@userProfile')->name('profile.userProfile');
    Route::put('users/profile/{id}','ProfileController@updateBasicInfo')->name('profile.updateBasicInfo');
    Route::put('users/profile/{id}/change-password','ProfileController@updateUserPassword')->name('profile.updateUserPassword');
    Route::put('users/profile/{id}/user-info','ProfileController@updateUserInfo')->name('profile.updateUserInfo');
    Route::put('users/profile/{id}/social-link','ProfileController@updateUserSocialLink')->name('profile.updateUserSocialLink');

    Route::get('settings','SiteSettingsController@settings')->name('siteSetting.settings');
    Route::put('settings/basic-info','SiteSettingsController@updateBasicInfo')->name('siteSetting.updateBasicInfo');
    Route::put('settings/meta','SiteSettingsController@updateMeta')->name('siteSetting.updateMeta');
    Route::put('settings/language','SiteSettingsController@language')->name('siteSetting.language');
    Route::get('settings/update/lamguage/{lang}','SiteSettingsController@languageDynamic')->name('siteSetting.languageDynamic');
    Route::put('settings/mail-service','SiteSettingsController@updateMailService')->name('siteSetting.updateMailService');
    /*Route::put('settings/user-info','SiteSettingsController@updateUserInfo')->name('siteSetting.updateUserInfo');
    Route::put('settings/social-link','SiteSettingsController@updateUserSocialLink')->name('siteSetting.updateUserSocialLink');*/


    Route::get('roles','RoleController@index')->name('roles.index');
    Route::post('roles','RoleController@store')->name('roles.store');
    Route::get('roles/{role}','RoleController@show')->name('roles.show');
    Route::get('roles/{role}/edit','RoleController@edit')->name('roles.edit');
    Route::put('roles/{role}','RoleController@update')->name('roles.update');
    Route::delete('roles/{role}','RoleController@destroy')->name('roles.destroy');

    Route::get('mazhab-list','MazhabController@index')->name('mazhabList.index');
    Route::delete('mazhab-list/delete-multiple','MazhabController@deleteMultiple')->name('mazhabList.deleteMultiple');
    Route::post('mazhab-list','MazhabController@store')->name('mazhabList.store');
    Route::get('mazhab-list/{id}/edit','MazhabController@edit')->name('mazhabList.edit');
    Route::put('mazhab-list/{id}','MazhabController@update')->name('mazhabList.update');
    Route::delete('mazhab-list/{id}','MazhabController@destroy')->name('mazhabList.destroy');

    Route::get('country-list','CountryController@index')->name('countryList.index');
    Route::post('country-list','CountryController@store')->name('countryList.store');
    Route::get('country-list/{id}/edit','CountryController@edit')->name('countryList.edit');
    Route::put('country-list/{id}','CountryController@update')->name('countryList.update');
    Route::delete('country-list/{id}','CountryController@destroy')->name('countryList.destroy');

    Route::get('place-list','PlaceController@index')->name('placeList.index');
    Route::post('place-list','PlaceController@store')->name('placeList.store');
    Route::get('place-list/{id}/edit','PlaceController@edit')->name('placeList.edit');
    Route::put('place-list/{id}','PlaceController@update')->name('placeList.update');
    Route::delete('place-list/{id}','PlaceController@destroy')->name('placeList.destroy');

    Route::get('language-list','LanguageListController@index')->name('languageList.index');
    Route::post('language-list','LanguageListController@store')->name('languageList.store');
    Route::get('language-list/{id}/edit','LanguageListController@edit')->name('languageList.edit');
    Route::put('language-list/{id}','LanguageListController@update')->name('languageList.update');
    Route::delete('language-list/{id}','LanguageListController@destroy')->name('languageList.destroy');

    Route::get('person-category','PersonCategoryController@index')->name('personCategoryList.index');
    Route::post('person-category','PersonCategoryController@store')->name('personCategoryList.store');
    Route::get('person-category/{id}/edit','PersonCategoryController@edit')->name('personCategoryList.edit');
    Route::put('person-category/{id}','PersonCategoryController@update')->name('personCategoryList.update');
    Route::delete('person-category/{id}','PersonCategoryController@destroy')->name('personCategoryList.destroy');

    Route::get('person-info','PersonController@index')->name('person-info.index');
    Route::get('person-info/create','PersonController@create')->name('person-info.create');
    Route::get('person-info/getBirthCity','PersonController@getBirthCity')->name('person-info.getBirthCity');
    Route::get('person-info/{id}/getBirthCity','PersonController@getBirthCity')->name('person-info.getBirthCity');
    Route::get('person-info/getDeathCity','PersonController@getDeathCity')->name('person-info.getDeathCity');
    Route::get('person-info/{id}/getDeathCity','PersonController@getDeathCity')->name('person-info.getDeathCity');
    Route::get('person-info/getreCity','PersonController@getResidenceCity')->name('person-info.getreCity');
    Route::get('person-info/{id}/getreCity','PersonController@getResidenceCity')->name('person-info.getreCity');
    Route::get('person-info/getreCityDynamic','PersonController@getResidenceCityDynamic')->name('person-info.getreCityDynamic');
    Route::get('person-info/{id}/getreCityDynamic','PersonController@getResidenceCityDynamic')->name('person-info.getreCityDynamic');
    Route::post('person-info','PersonController@store')->name('person-info.store');
    Route::get('person-info/{id}','PersonController@show')->name('person-info.show');
    Route::get('person-info/{id}/edit','PersonController@edit')->name('person-info.edit');
    Route::put('person-info/{id}','PersonController@update')->name('person-info.update');
    Route::delete('person-info/{id}','PersonController@destroy')->name('person-info.destroy');
    Route::get('person-info/rolesPermissions','PersonController@rolesPermissions')->name('person-info.rolesPermissions');

    Route::get('book-basic-info/create','BookBasicInfoController@create')->name('bookBasicInfo.create');
    Route::get('book-basic-info/getRelatedBook','BookBasicInfoController@getRelatedBook')->name('bookBasicInfo.getRelatedBook');
    Route::get('book-basic-info/{id}/getRelatedBookDynamic','BookBasicInfoController@getRelatedBookDynamic')->name('bookBasicInfo.getRelatedBookDynamic');
    Route::get('book-basic-info/getwritingCityDynamic','BookBasicInfoController@getwritingCityDynamic')->name('bookBasicInfo.getwritingCityDynamic');
    Route::get('book-basic-info/{id}/getwritingCityDynamic','BookBasicInfoController@getwritingCityDynamic')->name('bookBasicInfo.getwritingCityDynamic');
    Route::get('book-basic-info','BookBasicInfoController@index')->name('bookBasicInfo.index');
    Route::post('book-basic-info','BookBasicInfoController@store')->name('bookBasicInfo.store');
    Route::get('book-basic-info/{id}/edit','BookBasicInfoController@edit')->name('bookBasicInfo.edit');
    Route::put('book-basic-info/{id}','BookBasicInfoController@update')->name('bookBasicInfo.update');
    Route::delete('book-basic-info/{id}','BookBasicInfoController@destroy')->name('bookBasicInfo.destroy');
    Route::get('book-basic-info/{id}','BookBasicInfoController@show')->name('bookBasicInfo.show');

    Route::get('published-book-info/create','PublishedBookInfoController@create')->name('publishedBookInfo.create');
    Route::get('published-book-info/getbookDynamic','PublishedBookInfoController@getbookDynamic')->name('publishedBookInfo.getbookDynamic');
    Route::get('published-book-info/{id}/getbookDynamic','PublishedBookInfoController@getbookDynamic')->name('publishedBookInfo.getbookDynamic');
    Route::post('published-book-info','PublishedBookInfoController@store')->name('publishedBookInfo.store');
    Route::get('published-book-info','PublishedBookInfoController@index')->name('publishedBookInfo.index');
    Route::get('published-book-info/{id}','PublishedBookInfoController@show')->name('publishedBookInfo.show');
    Route::get('published-book-info/{id}/edit','PublishedBookInfoController@edit')->name('publishedBookInfo.edit');
    Route::put('published-book-info/{id}','PublishedBookInfoController@update')->name('publishedBookInfo.update');
    Route::delete('published-book-info/{id}','PublishedBookInfoController@destroy')->name('publishedBookInfo.destroy');

    Route::get('library-list/create','LibraryListController@create')->name('libraryList.create');
    Route::get('library-list/getLibraryCity','LibraryListController@getLibraryCity')->name('libraryList.getLibraryCity');
    Route::get('library-list/{id}','LibraryListController@show')->name('libraryList.show');
    Route::post('library-list','LibraryListController@store')->name('libraryList.store');
    Route::get('library-list','LibraryListController@index')->name('libraryList.index');
    Route::get('library-list/{id}/edit','LibraryListController@edit')->name('libraryList.edit');
    Route::get('library-list/{id}/getLibrarycityUpdate','LibraryListController@getLibrarycityUpdate')->name('libraryList.getLibrarycityUpdate');
    Route::put('library-list/{id}','LibraryListController@update')->name('libraryList.update');
    Route::delete('library-list/{id}','LibraryListController@destroy')->name('libraryList.destroy');

    Route::get('manuscript-info/create','ManuscriptInfoController@create')->name('manuscriptInfo.create');
    Route::get('manuscript-info/getbookDynamic','ManuscriptInfoController@getbookDynamic')->name('manuscriptInfo.getbookDynamic');
    Route::get('manuscript-info/{id}/getbookDynamic','ManuscriptInfoController@getbookDynamic')->name('manuscriptInfo.getbookDynamic');
    Route::post('manuscript-info','ManuscriptInfoController@store')->name('manuscriptInfo.store');
    Route::get('manuscript-info','ManuscriptInfoController@index')->name('manuscriptInfo.index');
    Route::get('manuscript-info/{id}/edit','ManuscriptInfoController@edit')->name('manuscriptInfo.edit');
    Route::put('manuscript-info/{id}','ManuscriptInfoController@update')->name('manuscriptInfo.update');
    Route::delete('manuscript-info/{id}','ManuscriptInfoController@destroy')->name('manuscriptInfo.destroy');
    Route::get('manuscript-info/{id}','ManuscriptInfoController@show')->name('manuscriptInfo.show');

    Route::get('publication-info/create','PublicationInfoController@create')->name('publicationInfo.create');
    Route::get('publication-info/getPublicationCity','PublicationInfoController@getPublicationCity')->name('publicationInfo.getPublicationCity');
    Route::get('publication-info/{id}','PublicationInfoController@show')->name('publicationInfo.show');
    Route::post('publication-info','PublicationInfoController@store')->name('publicationInfo.store');
    Route::get('publication-info','PublicationInfoController@index')->name('publicationInfo.index');
    Route::get('publication-info/{id}/edit','PublicationInfoController@edit')->name('publicationInfo.edit');
    Route::get('publication-info/{id}/getPublicationcityUpdate','PublicationInfoController@getPublicationcityUpdate')->name('publicationInfo.getPublicationcityUpdate');
    Route::put('publication-info/{id}','PublicationInfoController@update')->name('publicationInfo.update');
    Route::delete('publication-info/{id}','PublicationInfoController@destroy')->name('publicationInfo.destroy');

    Route::get('book-category','BookCategoryController@index')->name('bookCategory.index');
    Route::post('book-category','BookCategoryController@store')->name('bookCategory.store');
    Route::get('book-category/{id}/edit','BookCategoryController@edit')->name('bookCategory.edit');
    Route::put('book-category/{id}','BookCategoryController@update')->name('bookCategory.update');
    Route::delete('book-category/{id}','BookCategoryController@destroy')->name('bookCategory.destroy');

});