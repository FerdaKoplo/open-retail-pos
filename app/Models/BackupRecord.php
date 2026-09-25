<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupRecord extends Model
{
    protected $fillable = [
        'created_by',
        'filename',
        'storage_path',
        'size_bytes',
        'checksum_sha256',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
