<?php

Route::group(['prefix' => 'fms', 'namespace'=>'Fms', 'as' => 'fms.'], function () {
  // Route::get('/','DashBoardController@index')->name('index');

  Route::post('file/datatables', 'FileController@getDataTables')->name('file.datatables');
  Route::get('file/{id}/download', 'FileController@download')->where(['id'=>'[0-9]+'])->name('file.download');
  Route::get('files/download', 'FileController@download')->name('files.download');
  Route::resource('file', 'FileController');
  Route::resource('file.movement', 'FileMovementController')->only(['create','store']);
  Route::get('file/{id}/movement/return', 'FileMovementController@return')->where(['id'=>'[0-9]+'])->name('file.return');

  Route::post('reference/datatables', 'ReferenceController@getDataTables')->name('reference.datatables');
  Route::get('reference/typeahead/{search}', 'ReferenceController@typeaheadJson')->name('reference.typeahead');
  Route::resource('/reference', 'ReferenceController');

  Route::post('publisher/datatables', 'PublisherController@getDataTables')->name('publisher.datatables');
  Route::resource('/publisher', 'PublisherController');
});
