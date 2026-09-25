<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function openedCashSessions()
    {
        return $this->hasMany(CashSession::class, 'opened_by');
    }

    public function closedCashSessions()
    {
        return $this->hasMany(CashSession::class, 'closed_by');
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class, 'created_by');
    }

    public function receivedPurchaseReceipts()
    {
        return $this->hasMany(PurchaseReceipt::class, 'received_by');
    }

    public function createdStockAdjustments()
    {
        return $this->hasMany(StockAdjustment::class, 'created_by');
    }

    public function approvedStockAdjustments()
    {
        return $this->hasMany(StockAdjustment::class, 'approved_by');
    }

    public function createdStockOpnames()
    {
        return $this->hasMany(StockOpname::class, 'created_by');
    }

    public function completedStockOpnames()
    {
        return $this->hasMany(StockOpname::class, 'completed_by');
    }
}
