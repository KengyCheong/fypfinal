<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Approval Status
    Route::apiResource('approval-statuses', 'ApprovalStatusApiController');

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Illness Tags
    Route::apiResource('illness-tags', 'IllnessTagsApiController');

    // Vaccine Tags
    Route::apiResource('vaccine-tags', 'VaccineTagsApiController');

    // Users Info
    Route::apiResource('users-infos', 'UsersInfoApiController');
});
