<?php

namespace App\Enums\ViewPaths\Admin;

enum Author
{
    const LIST = [
        URI => 'view',
        VIEW => 'admin-views.author.view'
    ];

    const STORE = [
        URI => 'store',
        VIEW => ''
    ];

    const UPDATE = [
        URI => 'update',
        VIEW => 'admin-views.author.edit'
    ];

    const DELETE = [
        URI => 'delete',
        VIEW => ''
    ];
}
