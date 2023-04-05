<?php
namespace App\Enums;

enum PostStatus:string
{
	case PUBLISH = 'publish';
	case DRAFT = 'draft';
	case FUTURE = 'future';
	case PENDING = 'pending';
	case TRASH = 'trash';
	case REJECTED = 'rejected';
}

/*
Route::get('/', function () {
    \App\Models\User::create([
        'role' => \App\Enum\UserRoleEnum::EDITOR,
        'full_name' => 'Aziz Sancar',
    ]);
});

Route::get('/get-editors', function () {
    $editors = \App\Models\User::where('role', \App\Enum\UserRoleEnum::EDITOR)->get();

    dd($editors);
});

Route::get('/get-all-enums', function (){
    dd(\App\Enum\UserRoleEnum::cases());
});
*/