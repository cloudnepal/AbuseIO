<?php namespace AbuseIO\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

/**
 * Class PermissionRole
 * @package AbuseIO\Models
 * @property integer $id
 * @property integer $role_id
 * @property integer $permission_id
 */
class PermissionRole extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permission_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    /*
     * Validation method for this model being created
     * $rules is inside function because of interaction with $data
     */
    public function validateCreate($data)
    {
        $rules = [
            'role_id'               => "required|integer|unique:permission_role,role_id,NULL,id,permission_id,{$data['permission_id']}",
            'permission_id'         => "required|integer|unique:permission_role,permission_id,NULL,id,role_id,{$data['role_id']}",
        ];

        $validation = Validator::make($data, $rules);

        return $validation;
    }

    /*
     * Validation method for this model being updated
     * $rules is inside function because of interaction with $data
     */
    public function validateUpdate($data)
    {
        $rules = [
            'id'                    => 'required|exists:permissions_role,id',
            'role_id'               => "required|integer|unique:permission_role,role_id,NULL,id,permission_id,{$data['permission_id']}",
            'permission_id'         => "required|integer|unique:permission_role,permission_id,NULL,id,role_id,{$data['role_id']}",
        ];

        $validation = Validator::make($data, $rules);

        return $validation;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
     * One-To-Many relation to account
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('AbuseIO\Models\Role');
    }

    /**
     * One-To-Many relation to account
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('AbuseIO\Models\Permission');
    }
}
