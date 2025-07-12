<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
  protected $fillable = [
    'title',
    'type',
    'amount',
    'description',
    'report_date',
    'user_id'
  ];

  protected $casts = [
    'report_date' => 'date',
    'amount' => 'decimal:2'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
