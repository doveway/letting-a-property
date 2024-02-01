<?php

namespace App\Models;

use App\Models\SupportCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'details',
    ];

    public function SupportCategory(){
        return $this->belongsTo(SupportCategory::class);
    }
}
