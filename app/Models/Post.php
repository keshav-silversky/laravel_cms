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


    public function getImageAttribute($value)
    {
      if(filter_var($value,FILTER_VALIDATE_URL))
      {
        return $value;
      }
      else
      {
        return asset("storage/uploads/$value");
      }

    }
    public function setImageAttribute($value)
    {  
        if(filter_var($value,FILTER_VALIDATE_URL))
        {
            $this->attributes['image'] = $value;
        }
        else
        {
       $this->attributes['image'] = basename($value);      
        }
    }

}
