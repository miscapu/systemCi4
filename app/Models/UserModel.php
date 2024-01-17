<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'firstname', 'lastname', 'email', 'password', 'role', 'created_at', 'updated_at'  ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [ 'beforeInsert' ];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [ 'beforeUpdate' ];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    protected function passwordHatch( array $data )
    {
        if ( isset( $data[ 'data' ][ 'password' ] ) )
        {
            $data[ 'data' ][ 'password' ]   =   password_hash( $data[ 'data' ][ 'password' ], PASSWORD_DEFAULT );
        }

        return $data;
    }


    protected function beforeInsert( array $data)
    {
        $data   =   $this->passwordHatch( $data );
        $data[ 'data' ][ 'created_at' ] =   date( 'Y-m-d H:i:s' );

        return $data;
    }

    protected function beforeUpdate( array $data)
    {
        $data   =   $this->passwordHatch( $data );
        $data[ 'data' ][ 'updated_at' ] =   date( 'Y-m-d H:i:s' );

        return $data;
    }



}
