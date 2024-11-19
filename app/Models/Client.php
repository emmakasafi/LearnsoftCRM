<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'clients';

    public $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'email_address',
        'phone_number',
        'lead_id',
        'employee_id',
        'location'
    ];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'company_name' => 'string',
        'email_address' => 'string',
        'location' => 'string'
    ];

    public static array $rules = [
        'first_name' => 'required|string|max:100',
        'last_name' => 'nullable|string|max:100',
        'company_name' => 'nullable|string|max:100',
        'email_address' => 'required|string|max:100',
        'phone_number' => 'nullable',
        'lead_id' => 'nullable|exists:leads,id',
        'location' => 'nullable|string|max:200'
    ];

    public function lead(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Lead::class, 'lead_id');
    }

    public function interactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Interaction::class, 'client_id');
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Order::class, 'client_id');
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Transaction::class, 'client_id');
    }

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

    protected static function booted()
    {
        parent::boot();

        // Automatically create an interaction for new clients
        static::created(function ($client) {
            Interaction::create([
                'client_id' => $client->id,
                'lead_id' => $client->lead_id,  // Link to the lead if provided
                'type' => 'Client',
                'description' => 'New order made',
                'interactions_date' => now()->toDateString(),
            ]);
        });
    }
}
