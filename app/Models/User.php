<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory,HasRolesAndPermissions, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'sponsor_id',
        'password',
    ];


    public $profile_fillable = [
        'password',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function wallet(){
        return $this->hasOne(Wallet::class);
    }

    public function sponsor(){
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    public function getCurrentUpgradeAttribute(){
        return Upgrade::where('user_id', $this->id)->where('status', status_name('COMPLETED'))->orderBy('id', 'desc')->first();
    }

    public function getAffiliatesAttribute()
    {
        // count sponsor id same as this user id
        return User::where('sponsor_id', $this->id)->count();
    }

    public function getUpgradesAttribute()
    {
        // count sponsor id same as this user id
        return Upgrade::where('user_id', $this->id)->where('status', status_name('COMPLETED'))->sum('amount');
    }

    public function getIncomeAttribute()
    {
        // count sponsor id same as this user id
        return MatchedHistory::where('receiver_user_id', $this->id)->sum('amount');
    }

    public function getNextUpgradeAttribute()
    {
        // count sponsor id same as this user id
        if ($upgrade = Upgrade::where('user_id', $this->id)->orderBy('id', 'desc')->first()) {
           if ($upgrade->status == status_name('COMPLETED')&&$upgrade?->package?->level) {
              $nextUpgrade = Package::where('level', '>', $upgrade->package->level)->orderBy('id', 'asc')->first();
              if ($nextUpgrade) {
                return $nextUpgrade;
              }else{
                return null;
              }
           }else{
               return null;
           }
        }else{
            return Package::first();
        }

    }

    public function getMustUpgradeAttribute(){
        if($this->current_upgrade){
            if($this->current_upgrade->received >= $this->current_upgrade->expected){
                return true;
            }
        }
    }

    public function getMustActivateAttribute(){
        if(!Activation::where('user_id', $this->id)->where('status', status_name('COMPLETED'))->first()){
            return true;
        }
    }
}
