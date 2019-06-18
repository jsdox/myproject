<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\BaseModel;
use Validator;
use Illuminate\Database\Eloquent\Model as Eloquent;
class User extends Eloquent
{
    use Notifiable;
//    private $errors;

    use \App\Traits\CustomValidator
    {
        validateObject as protected traitValidateObject;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $_rules = [
        'name' => 'required',
        'email' => 'required|unique:users|regex:/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/',
        'password'  => 'required',
    ];
    
//    public function validate($data)
//    {
//
//        $v = Validator::make($data, $this->rules);
//        if ($v->fails()) {
//            $this->errors = $v->errors()->toArray();
//            return false;
//        }
//        return true;
//    }
//
//    public function errors()
//    {
//        return $this->errors;
//    }
    
    public function __construct(array $attributes = [])
    {
       parent::__construct($attributes);
       if (count($attributes)) {
            $this->setDataInternally($attributes);
       }
    }
    
    public function setDataInternally($attributes = [])
    {
        if (isset($attributes['email']))
            $this->email = strtolower(trim($attributes['email']));
        if (isset($attributes['password']) && !empty($attributes['password']))
            $this->password = \bcrypt($attributes['password']);
        return true;
    }
    
    public function save(array $options = [])
    {
        if (!$this->traitValidateObject($options))
            return false;
        return parent::save($options);
    }
}

