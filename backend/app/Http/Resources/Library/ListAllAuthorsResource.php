<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Author;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class ListAllAuthorsResource extends JsonResource
{
    /**
     * @param Author $author
     */
    public function __construct(private Author $author)
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
            'id' => $this->author->id,
            'name' => $this->author->getFullName(),
            'createdAt' => $this->author->createdAt->format(DateTime::ATOM),
            'updatedAt' => $this->author->updatedAt->format(DateTime::ATOM),
        ];
    }
}
