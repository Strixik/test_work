<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use Notifiable;

    const ROLE_1 = 0;
    const ROLE_2 = 1;

    const ROLES = [self::ROLE_1 => 'Role1', self::ROLE_2 => 'Role2'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'role'
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

    /** Получить токен
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->api_token;
    }
    /** Получить роль
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /** Установить  и сохранить токен по умолчанию null.
     * @param null $token
     */
    public function setApiToken($token = null)
    {
        $this->api_token = $token;
        $this->save();
    }

    /** Проверка или существует токен
     * @param string $api_token
     * @return mixed
     */
    public static function tokenExists($api_token)
    {
        return self::where('api_token', $api_token)->exists();
    }

    /** Получить юзера из токена
     * @param $api_token
     * @return mixed
     */
    public static function getUserFromToken($api_token)
    {
        return self::where('api_token', $api_token)->first();
    }

    /** Генирацыя уникального токена
     * @return string
     */
    public function generateUnToken()
    {
        $token = '';
        while (true) {
            $token = Str::random(60);
            if (!self::where('api_token', $token)->first()) {
                break;
            }
        }

        return $token;
    }
}
