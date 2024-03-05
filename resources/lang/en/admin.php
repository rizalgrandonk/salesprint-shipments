<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',

            //Belongs to many relations
            'roles' => 'Roles',

        ],
    ],

    'shipment' => [
        'title' => 'Shipments',

        'actions' => [
            'index' => 'Shipments',
            'create' => 'New Shipment',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'awb' => 'Awb',
            'courier' => 'Courier',
            'service' => 'Service',
            'status' => 'Status',
            'desc' => 'Desc',
            'amount' => 'Amount',
            'weight' => 'Weight',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'shipper' => 'Shipper',
            'receiver' => 'Receiver',
            'created_at' => 'Created At',

        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];