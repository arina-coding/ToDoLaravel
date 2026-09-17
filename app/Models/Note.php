<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text',
        'category',
        'status',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getShortTextAttribute(){
        $text= $this->text ?? '';
        $short=mb_substr($text, 0, 25);

        if(mb_strlen($text)>25){
            $short .= '...';
        }

        return $short;
    }

}
