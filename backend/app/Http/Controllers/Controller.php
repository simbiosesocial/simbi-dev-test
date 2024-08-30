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
 *     schema="Author",
 *     type="object",
 *     title="Author",
 *     description="Author entity",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="ID of the author",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Full name of the author"
 *     ),
 *     @OA\Property(
 *         property="createdAt",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the author was created",
 *         example="2024-08-29T04:25:50.000000Z"
 *     ),
 *     @OA\Property(
 *         property="updatedAt",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the author was last updated",
 *         example="2024-08-29T04:25:50.000000Z"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="AuthorName",
 *     type="object",
 *     title="AuthorName",
 *     description="Name of the author",
 *     @OA\Property(
 *         property="firstName",
 *         type="string",
 *         description="First name of the author",
 *         example="Zula"
 *     ),
 *     @OA\Property(
 *         property="lastName",
 *         type="string",
 *         description="Last name of the author",
 *         example="Considine"
 *     )
 * )
 *
 *  * @OA\Schema(
 *     schema="Book",
 *     type="object",
 *     title="Book",
 *     description="Book entity",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="ID of the book",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Title of the book",
 *         example="Curso avançado de Java"
 *     ),
 *     @OA\Property(
 *         property="publisher",
 *         type="string",
 *         description="Publisher of the book",
 *         example="Editora XPTO"
 *     ),
 *     @OA\Property(
 *         property="authorId",
 *         type="string",
 *         description="ID of the author",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="author",
 *         ref="#/components/schemas/Author",
 *         description="Author of the book",
 *     ),
 *     @OA\Property(
 *         property="isAvailable",
 *         type="boolean",
 *         description="Availability status of the book",
 *         example=true
 *     ),
 *     @OA\Property(
 *         property="createdAt",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the book was created",
 *         example="2024-08-29T04:25:50.000000Z"
 *     ),
 *     @OA\Property(
 *         property="updatedAt",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the book was last updated",
 *         example="2024-08-29T04:25:50.000000Z"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="Loan",
 *     type="object",
 *     title="Loan",
 *     description="Loan entity",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="ID of the loan",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="loanDate",
 *         type="string",
 *         format="date-time",
 *         description="Date when the loan was made",
 *         example="2024-08-29T04:25:50.000000Z"
 *     ),
 *     @OA\Property(
 *         property="returnDate",
 *         type="string",
 *         format="date-time",
 *         description="Date when the loan is expected to be returned",
 *         example="2024-09-29T04:25:50.000000Z"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Status of the loan",
 *         enum={"created", "active", "finished", "overdue"},
 *         example="active"
 *     ),
 *     @OA\Property(
 *         property="returnedAt",
 *         type="string",
 *         format="date-time",
 *         description="Date when the loan was returned",
 *         example="2024-09-15T04:25:50.000000Z",
 *         nullable=true
 *     ),
 *     @OA\Property(
 *         property="renewalCount",
 *         type="integer",
 *         description="Number of times the loan has been renewed",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="lastRenewedAt",
 *         type="string",
 *         format="date-time",
 *         description="Date when the loan was last renewed",
 *         example="2024-09-10T04:25:50.000000Z"
 *     ),
 *     @OA\Property(
 *         property="book",
 *         type="object",
 *         description="Book associated with the loan",
 *         ref="#/components/schemas/Book"
 *     ),
 *     @OA\Property(
 *         property="createdAt",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the loan was created",
 *         example="2024-08-29T04:25:50.000000Z"
 *     ),
 *     @OA\Property(
 *         property="updatedAt",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the loan was last updated",
 *         example="2024-08-29T04:25:50.000000Z"
 *     )
 * )
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
