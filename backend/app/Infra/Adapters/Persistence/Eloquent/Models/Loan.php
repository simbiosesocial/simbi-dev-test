<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models;

use Database\Factories\LoanFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Loan extends Model
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

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'book_id',
        'loan_date',
        'return_date',
        'returned_at',
        'status',
        'renewal_count',
        'last_renewed_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The books that belong to the loan.
     *
     * @return BelongsToMany
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return LoanFactory::new();
    }
}
