<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="Laravel Template Simbi API", version="1.0")
 *
 * @OA\Schema(
 *     schema="Resource Not Found Error",
 *     type="object",
 *     @OA\Property(property="error",
 *       @OA\Property(property="message", type="string", description="Mensagem de erro"),
 *     ),
 *   )
 * )
 *
 * @OA\Schema(
 *     schema="Bad Request",
 *     type="object",
 *     @OA\Property(property="error",
 *       @OA\Property(property="message", type="string", description="Mensagem de erro"),
 *     ),
 *   )
 * )
 *
 * @OA\Schema(
 *     schema="Internal server error",
 *     type="object",
 *     @OA\Property(property="error",
 *       @OA\Property(property="message", type="string", description="Mensagem de erro"),
 *     ),
 *   )
 * )
 *
 * @OA\Schema(
 *     schema="Forbidden Error",
 *     type="object",
 *     @OA\Property(property="error",
 *       @OA\Property(property="message", type="string", description="Mensagem de erro"),
 *     ),
 *   )
 * )
 *
 * @OA\Schema(
 *     schema="Unauthorized Error",
 *     type="object",
 *     @OA\Property(property="error",
 *       @OA\Property(property="message", type="string", description="Mensagem de erro"),
 *     ),
 *   )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
