<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('user_id', 'title', 'description', 'due_date', 'status')]
class Task extends Model
{
    //
}
