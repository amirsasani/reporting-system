<?php

namespace Amirsasani\ReportingSystem\Models;

use Amirsasani\ReportingSystem\Database\Factories\ReportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;

    protected $fillable = ['user_id', 'user_type', 'resource_type', 'details', 'report_status', 'report_count'];

    protected $casts = [
        'details' => 'array'
    ];

    protected static function newFactory()
    {
        return ReportFactory::new();
    }

    public function user()
    {
        return $this->morphTo();
    }
}