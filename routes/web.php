<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index'])->name('home');
Route::get('/storage_local_create', [FileController::class, 'storageLocalCreate'])->name('storage.local.create');
Route::get('/storage_local_append', [FileController::class, 'storageLocalAppend'])->name('storage.local.append');
Route::get('/storage_local_read', [FileController::class, 'storageLocalRead'])->name('storage.local.read');
Route::get('/storage_local_read_multi', [FileController::class, 'storageLocalReadMulti'])->name('storage.local.read.multi');
Route::get('/storage_local_check_file', [FileController::class, 'storageLocalCheckFile'])->name('storage.local.check.file');
Route::get('/storage_local_store_json', [FileController::class, 'storeJson'])->name('storage.local.store.json');
Route::get('/storage_local_read_json', [FileController::class, 'readJson'])->name('storage.local.read.json');
Route::get('/storage_local_list', [FileController::class, 'listFiles'])->name('storage.local.list');
Route::get('/storage_local_delete', [FileController::class, 'deleteFile'])->name('storage.local.delete');

// Folders
Route::get('/storage_local_create_folder', [FileController::class, 'createFolder'])->name('storage.local.create.folder');
Route::get('/storage_local_delete_folder', [FileController::class, 'deleteFolder'])->name('storage.local.delete.folder');

// Metadata
Route::get('/storage_local_list_files_metadata', [FileController::class, 'listFilesWithMetadata'])->name('storage.local.list.files.metadata');

// Download
Route::get('/storage_local_list_files_for_download', [FileController::class, 'listFilesForDownload'])->name('storage.local.list.for.download');
Route::get('/download/{file}', function($file){
    // die($file);
    return response()->download('storage/' . $file);
})->name('download');

// Upload
Route::post('/storage_local_upload', [FileController::class, 'uploadFile'])->name('storage.local.upload');
