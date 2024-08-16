<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Book;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class ListBooksByAuthorResource extends JsonResource
{
    /**
     * @param Book $book
     */
    public function __construct(private Book $book)
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
        return [
            'id' => $this->book->id,
            'title' => $this->book->title,
            'publisher' => $this->book->publisher,
            'createdAt' => $this->book->createdAt->format(DateTime::ATOM),
            'updatedAt' => $this->book->updatedAt->format(DateTime::ATOM),
        ];
    }
}
