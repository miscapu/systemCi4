<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public $userModel;

    public function __construct()
    {
        $this->userModel    =   new UserModel();
    }

    public function index()
    {
        $users  =   $this->userModel->asObject()->findAll();

        $data   =   [
            'title' =>  'Dashboard',
            'users' =>  $users
        ];

        $renderT    =   \Config\Services::renderer();
        return $renderT->setData( $data )->render( 'Pages/Dashboard' );
    }
}
