<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashSession extends Model
{
    protected $fillable = [
        'register_id',
        'opened_by',
        'closed_by',
        'opening_cash',
        'expected_cash',
        'actual_cash',
        'difference',
        'status',
        'notes',
    ];

    public function register()
    {
        return $this->belongsTo(Register::class);
    }

    public function openedBy()
    {
        return $this->belongsTo(User::class, 'opened_by');
    }

    public function closedBy()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }
}
