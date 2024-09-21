<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models;

use Illuminate\Support\Str;
use Database\Factories\LoanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
use HasFactory;
/**
 * Indicates if the model's ID is auto-incrementing.
 *
 * @var bool
 */
public $incrementing = false;

/**
 * The table associated with the model.
 *
 * @var string
 */
protected $table = 'loans';

/**
 * The data type of the auto-incrementing ID.
 *
 * @var string
 */
protected $keyType = 'string';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = ['user_email', 'book_id', 'author_id', 'loan_date', 'return_date'];

  /**
     * @return BelongsTo
     */
public function book(): BelongsTo
{
    return $this->belongsTo(Book::class);
}

   /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }


/**
 * @return Factory
 */
protected static function newFactory(): Factory
{
    return LoanFactory::new();
}

protected static function boot()
{
    parent::boot();

    static::creating(function (Loan $loan) {
        $loan->id = Str::uuid();
    });
}
}