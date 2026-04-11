<?php

namespace App\Enums\ViewPaths\Admin;

enum CustomerSlice
{
    const VIEW = [
        URI => 'customer-slice',
        VIEW => 'admin-views.customer-slice.index'
    ];

    const LIST = [
        URI => 'fetch',
        VIEW => ''
    ];

    const ADD = [
        URI => 'customer-slice-store',
        VIEW => ''
    ];

    const GET_UPDATE = [
        URI => 'customer-slice-edit',
        VIEW => ''
    ];

    const UPDATE = [
        URI => 'customer-slice-update',
        VIEW => ''
    ];

    const DELETE = [
        URI => 'customer-slice-delete',
        VIEW => ''
    ];

    const STATUS = [
        URI => 'customer-slice-status-update',
        VIEW => ''
    ];
}
