<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Author;
use DateTimeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateAuthorResource extends JsonResource
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
            'createdAt' => $this->author->createdAt->format(DateTimeInterface::ATOM),
            'updatedAt' => $this->author->updatedAt->format(DateTimeInterface::ATOM),
        ];
    }
}
