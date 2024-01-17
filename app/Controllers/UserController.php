<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{

    /**
     * @var UserModel
     */
    public $userModel;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userModel    =   new UserModel();
    }


    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function index()
    {
        helper( [ 'form' ] );

        $data   =   [
            'title'             =>  'Login'
        ];

        if ( $this->request->getMethod() == 'post' )
        {
            $rules  =   [
                'emailFrm'      =>  'required|min_length[3]|max_length[50]|valid_email',
                'pwdFrm'        =>  'required|min_length[3]|max_length[255]|validateUser[emailFrm,pwdFrm]'
            ];
            $messages   =   [
                'emailFrm'      =>  [
                    'required'      =>  'Please, enter your email',
                    'min_length'    =>  'Please, min length email dont correct',
                    'max_length'    =>  'Please, max length email dont correct',
                    'valid_email'   =>  'Please, insert a valid email',
                ],

                'pwdFrm'      =>  [
                    'required'      =>  'Please, enter your Password',
                    'min_length'    =>  'Please, min length password dont correct',
                    'max_length'    =>  'Please, max length password dont correct',
                    'validateUser'  =>  'User dont exist'
                ],
            ];

            if ( ! $this->validate( $rules, $messages ) )
            {
                $data[ 'validation' ] = $this->validator;
            }else
                {
                    $user   =   $this->userModel->where( 'email', $this->request->getVar( 'emailFrm' ) )
                                    ->first();

                    $this->setUserSession( $user );
                    return redirect()->to( '/dashboard' );
                }
        }

        $renderT    =   \Config\Services::renderer();
        return $renderT->setData( $data )->render( 'Pages/Login' );
    }

    /**
     * @param $user
     * @return bool
     */
    private function setUserSession( $user )
    {
        $data   =   [
            'id'        =>  $user[ 'id' ],
            'firstname' =>  $user[ 'firstname' ],
            'lastname'  =>  $user[ 'lastname' ],
            'email'     =>  $user[ 'email' ],
            'isLoggedIn'=>  true
        ];

        session()->set( $data );
        return true;
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * @throws \ReflectionException
     */
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
                    'required'      =>  'Please, insert your password',
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

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to( '/' );
    }
}


