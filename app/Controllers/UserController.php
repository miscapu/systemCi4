<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{

    public $userModel;

    public function __construct()
    {
        $this->userModel    =   new UserModel();
    }

    public function index()
    {
        helper( [ 'form' ] );

        $data   =   [
            'title'             =>  'Login'
        ];

        $renderT    =   \Config\Services::renderer();
        return $renderT->setData( $data )->render( 'Pages/Login' );
    }

    public function register()
    {
        helper( [ 'form' ] );

        $data   =   [
            'title'             =>  'Register'
        ];

        if ( $this->request->getMethod()    == 'post' )
        {
            $rules      =   [
                'firstnameFrm'      =>  'required|min_length[3]|max_length[50]',
                'lastnameFrm'       =>  'required|min_length[3]|max_length[80]',
                'emailFrm'          =>  'required|min_length[3]|max_length[80]|valid_email|is_unique[users.email]',
                'pwdFrm'            =>  'required|min_length[3]|max_length[255]',
                'cfpwdFrm'          =>  'matches[pwdFrm]'
            ];

            $messages   =   [
                'firstnameFrm'      =>  [
                    'required'      =>  'Please, insert your first name',
                    'min_length'    =>  'Please, min length is 3',
                    'max_length'    =>  'Please, max length is 50',
                ],

                'lastnameFrm'      =>  [
                    'required'      =>  'Please, insert your last name',
                    'min_length'    =>  'Please, min length is 3',
                    'max_length'    =>  'Please, max length is 80',
                ],

                'emailFrm'      =>  [
                    'required'      =>  'Please, insert your email',
                    'min_length'    =>  'Please, min length is 3',
                    'max_length'    =>  'Please, max length is 50',
                    'valid_email'   =>  'Please, insert an email valid',
                    'is_unique'     =>  'Please, email is already!'
                ],

                'pwdFrm'      =>  [
                    'required'      =>  'Please, insert your password   ',
                    'min_length'    =>  'Please, min length is 3',
                    'max_length'    =>  'Please, max length is 255',
                ],

                'cfpwdFrm'      =>  [
                    'matches'      =>  'Please, password dont matches!',
                ],
            ];
            if ( !$this->validate( $rules, $messages ) ){
                $data[ 'validation' ]   =   $this->validator;
            }else
                {
                    $newData    =   [
                        'firstname'     =>  $this->request->getVar( 'firstnameFrm' ),
                        'lastname'      =>  $this->request->getVar( 'lastnameFrm' ),
                        'email'         =>  $this->request->getVar( 'emailFrm' ),
                        'password'      =>  $this->request->getVar( 'pwdFrm' ),
                    ];

                    $this->userModel->save( $newData );
                    $session    =   session();
                    $session->setFlashdata( 'success',  'Successfull Registration'  );

                    return redirect()->to( '/' );
                }
        }

        $renderT    =   \Config\Services::renderer();
        return $renderT->setData( $data )->render( 'Pages/Register' );
    }
}


