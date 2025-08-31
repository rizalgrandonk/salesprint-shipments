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

    'province' => [
        'title' => 'Provinces',

        'actions' => [
            'index' => 'Provinces',
            'create' => 'New Province',
            'edit' => 'Edit :name',
            'populate' => 'Populate Provinces',
            'populate_cities' => 'Populate Cities',
        ],

        'columns' => [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'province' => 'Province',
            
        ],
    ],

    'city' => [
        'title' => 'Cities',

        'actions' => [
            'index' => 'Cities',
            'create' => 'New City',
            'edit' => 'Edit :name',
            'populate' => 'Populate Cities',
            'populate_districts' => 'Populate Districts',
        ],

        'columns' => [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'province' => 'Province',
            'city_id' => 'City ID',
            'city_name' => 'City',
            
        ],
    ],

    'district' => [
        'title' => 'Districts',

        'actions' => [
            'index' => 'Districts',
            'create' => 'New District',
            'edit' => 'Edit :name',
            'populate' => 'Populate Districts',
        ],

        'columns' => [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'province' => 'Province',
            'city_id' => 'City ID',
            'city_name' => 'City',
            'district_id' => 'District ID',
            'district_name' => 'District',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];