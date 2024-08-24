<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models;

use Database\Factories\LoanFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'book_id', 'start_loan_date', 'end_loan_date'];

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

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
     * @return HasOne
     */
    public function book(): HasOne
    {
        return $this->hasOne(Book::class, "id", "book_id");
    }

    /**
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return LoanFactory::new();
    }
}
