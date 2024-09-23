<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Database\Factories\LoanFactory;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  //  protected $fillable = ['id', 'book_id', 'user_id', 'loan_date', 'return_date']; teste com user
    protected $fillable = ['id', 'book_id', 'loan_date', 'return_date'];

    /**
     * Define a relação com o Book.
     *
     * @return BelongsTo
     */
    public function book(): HasOne
    {
        return $this->hasOne(Book::class, "id", "book_id");
    }

    /**
     * Define a relação com o User.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }

    /**
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return LoanFactory::new();
    }
}
