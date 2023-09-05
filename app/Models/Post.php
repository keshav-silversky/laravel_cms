<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailables\Content;

class Post extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];
    protected $fillable = [
        'image',
        'title',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = basename($value);
      
    }

}
