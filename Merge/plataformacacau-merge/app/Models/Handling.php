<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handling extends Model
{
    protected $fillable = [
        'temple',
        'main',
    ];

    public function blocks()
    {
        $data = [
            'id' => $this->id,
            'temple' => $this->temple,
            'main' => $this->main,
        ];

        return $data;
    }
}
