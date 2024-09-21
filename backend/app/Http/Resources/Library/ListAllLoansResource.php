<?php

namespace App\Http\Resources\Library;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;

class ListAllLoansResource extends JsonResource
{
    /**
     * @param Loan $loan
     */
    public function __construct(private Loan $loan)
    {
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request = null)
    {
        $book = Book::find($this->loan->book_id);

        return [
            'book' => $book ? new ListAllBooksResource($book) : null,
            'user_email' => $this->loan->user_email,
            'author' => $this->loan->author ? new AuthorDetailsResource($this->loan->author) : null,
            'loan_date' => Carbon::parse($this->loan->loan_date)->format(DateTime::ATOM), // Converte a data
            'return_date' => Carbon::parse($this->loan->return_date)->format(DateTime::ATOM), // Converte a data
        ];
    }

}
