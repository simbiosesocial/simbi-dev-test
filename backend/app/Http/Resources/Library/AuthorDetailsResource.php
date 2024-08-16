<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Author;
use Illuminate\Http\Resources\Json\JsonResource;

final class AuthorDetailsResource extends JsonResource
{
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
        ];
    }
}
