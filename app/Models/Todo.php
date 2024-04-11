<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
    ];

    protected $appends = ['user_info'];

    public function user(): BelongsTo
    {
       return $this->belongsTo(User::class);
    }
    public function getUserInfoAttribute(): array
    {
        $user = $this->user;

        return [
            'name' => $user->name,
            'email' => $user->email
        ];
    }
}
