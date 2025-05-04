<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public function findForPassport($identifier)
    {
        return $this->orWhere('email', $identifier)
            ->orWhere('phone', $identifier)
            ->first();
    }
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function profile()
    {
        return $this->hasOne(profile::class);
    }
    public function category()
    {
        return $this->hasMany(category::class);
    }
    public function posts()
    {
        return $this->hasMany(post::class);
    }
    public function sendVerifyCode($code, $username)
    {
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);
        // $client = new Client();
        $headers = [
            'apikey' => 'OWU4NjNkYzItNGI4NS00YWFkLWFlODMtZWFhN2FjZTMxNmRjNDdiNDE3MDI4ZWViNDYyOTRhMGI2YWJkODcwZmFjMGE=',
            'accept' => '*/*',
            'Content-Type' => 'application/json',
        ];
        $body = '{
  "code": "23gu0ju6r9ce99a",
  "sender": "+983000505",
  "recipient": "' . $username . '",
  "variable": {
    "code": "' . $code . '"
  }
}';
        $request = new Request('POST', 'https://api2.ippanel.com/api/v1/sms/pattern/normal/send', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();

    }
}
