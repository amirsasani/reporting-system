<?php

namespace Amirsasani\ReportingSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class ReportLog extends Model
{
    protected $fillable = ['user_id', 'report_id', 'created_at'];

    public function user()
    {
        return $this->morphTo();
    }

    public function report()
    {
        $this->belongsTo(Report::class);
    }
}