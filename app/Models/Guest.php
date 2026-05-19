<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    // Поля, которые можно заполнять через форму
    protected $fillable = [
        'first_name',
        'last_name',
        'partner_first_name',
        'partner_last_name',
        'status',
        'with_partner',
        'message',
        'ip_address',
    ];

    // Приведение типов
    protected $casts = [
        'with_partner' => 'boolean',
    ];

    // Гости, которые придут
    public function scopeWillCome($query)
    {
        return $query->where('status', 'will_come');
    }

    // Гости, которые не придут
    public function scopeWillNotCome($query)
    {
        return $query->where('status', 'will_not_come');
    }

    // Полное имя гостя
    public function getPartnerFullNameAttribute(): ?string
    {
        if (!$this->with_partner || !$this->partner_first_name) {
            return null;
        }
        return trim(($this->partner_last_name ?? '') . ' ' . $this->partner_first_name);
    }

    // Сколько всего человек (1 или 2, если с парой)
    public function getTotalPersonsAttribute(): int
    {
        if ($this->status === 'will_not_come') {
            return 0;
        }
        return $this->with_partner ? 2 : 1;
    }
}
