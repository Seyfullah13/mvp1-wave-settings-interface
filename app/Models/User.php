<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Wave\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'password',
        'verification_code',
        'verified',
        'trial_ends_at',
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

    protected $with = [
        'contact',
    ];

    protected $appends = [
        'contacts',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    /**
     * Get user contacts
     *
     * @return Collection|Contact[]
     */
    public function getContactsAttribute(): Collection
    {
        return optional($this->contact)->contacts() ?? collect();
    }

    public function userRoles(): HasMany
    {
        return $this->hasMany(MyUserRole::class);
    }

    // Méthode pour récupérer toutes les propriétés dont il est le Owner
    public function ownedProperties()
    {
        return Property::whereHas('userRoles', function ($query) {
            $query->where('user_id', $this->id)
                ->whereHas('role', function ($roleQuery) {
                    $roleQuery->where('name', 'Owner');
                });
        });
    }

    //  Lier l'utilisateur et les clés api

    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

}