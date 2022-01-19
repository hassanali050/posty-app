<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body'
    ];

    //public function owned_by(User $user) {
        //return $user->id === $this->user_id;
    //}

    public function liked_by(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
