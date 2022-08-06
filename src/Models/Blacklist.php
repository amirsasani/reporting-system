<?php

namespace Amirsasani\ReportingSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $fillable = ['name', 'type'];
}