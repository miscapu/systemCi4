<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data   =   [
            'title' =>  'Dashboard'
        ];

        $renderT    =   \Config\Services::renderer();
        return $renderT->setData( $data )->render( 'Pages/Dashboard' );
    }
}
