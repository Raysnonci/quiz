<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table	= 'users';
    protected $primaryKey = 'user_id';

    use Notifiable;
    use Blameable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'user_email', 'user_password', 'user_visible_password', 'user_occupation', 'user_address', 'user_phone', 'user_is_admin', 
    ];

    public function getAuthPassword()
    {
        return $this->user_password;
    }


    public function getPrefixName()
    {
        return "user";
    }

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
        'user_email_verified_at' => 'datetime',
    ];

    private $limit=10;

    public function storeUser($data)
    {
        $data['user_visible_password'] = $data['password'];
        $data['user_password'] = bcrypt($data['password']);
        $data['user_is_admin'] = 0;
        return User::create($data);
    }

    public function allUsers()
    {
        return User::latest()->paginate($this->limit);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function updateUser($data, $id)
    {
        $user = User::find($id);

        if($data['password'])
        {
            $user->user_password = bcrypt($data['password']);
            $user->user_visible_password = $data['password'];
        }

        $user->user_name = $data['name'];
        $user->user_occupation = $data['occupation'];
        $user->user_address = $data['address'];
        $user->user_phone = $data['phone'];
        $user->save();
        return $user;
    }

    public function deleteUser($id)
    {
        return User::find($id)->delete();
    }
}
