<?php

namespace App\Enums\ViewPaths\Admin;

enum Tag
{
    const LIST = [
        URI => 'list',
        VIEW => 'admin-views.tag.list'
    ];
    const ADD = [
        URI => 'add-new',
        VIEW => 'admin-views.tag.add-new'
    ];

    const UPDATE = [
        URI => 'update',
        VIEW => 'admin-views.tag.edit'
    ];

    const DELETE = [
        URI => 'delete',
        VIEW => ''
    ];

    const STATUS = [
        URI => 'status-update',
        VIEW => ''
    ];

    const EXPORT = [
        URI => 'export',
        VIEW => ''
    ];
}
