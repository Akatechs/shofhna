<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $presenter = 'ArabiaIOClone\Presenters\UserPresenter';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'password_temp');
    protected $fillable = array(
        'email',
        'photo',
        'fullname',
        'username',
        'website',
        'password',
        'password_temp',
        'code',
        'reputation',
        'bio',
        'active',
        'is_admin',
        'twitter_id');

    public function posts() {
        return $this->hasMany('Post', 'user_id');
    }

    public function comments() {
        return $this->hasMany('Comment', 'user_id');
    }

    public function votes() {
        return $this->hasMany('Vote', 'user_id');
    }

    public function communities() {
        return $this->belongsToMany('Community');
    }

    public function favorites() {
        return $this->belongsToMany('Post', 'favorites');
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    // Added for Laravel 4.1.26 upgrade
    public function getRememberToken() {
        return $this->remember_token;
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

}
