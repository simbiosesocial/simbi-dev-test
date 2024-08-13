<?php

namespace App\Adapters\ViewModel;

use App\Core\Common\Ports\ViewModel;
use Illuminate\Http\Resources\Json\JsonResource;

final class JsonResourceViewModel implements ViewModel
{
    /**
     * @param JsonResource $resource
     */
    public function __construct(public JsonResource $resource)
    {
    }

    /**
     * @return JsonResource
     */
    public function getResponse(): JsonResource
    {
        return $this->resource;
    }
}
