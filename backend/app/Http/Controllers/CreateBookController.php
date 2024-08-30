<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\CreateBook\{CreateBookRequestModel, CreateBookUseCase};
use App\Http\Requests\CreateBookRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateBookController extends Controller
{
    /**
     * @param CreateBookUseCase $useCase
     */
    public function __construct(private CreateBookUseCase $useCase)
    {
    }

    /**
     * Permite adicionar um novo livro
     *
     * @OA\Post(
     *    path="/api/books",
     *    summary="Adiciona um novo livro na API",
     *    tags={"Books"},
     *
     *    @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        type="object",
     *        required={"title","publisher", "authorId"},
     *        @OA\Property(property="title", type="string"),
     *        @OA\Property(property="publisher", type="string"),
     *        @OA\Property(property="authorId", type="string"),
     *      )
     *    ),
     *
     *    @OA\Response(
     *      response=201,
     *      description="Book Created",
     *      @OA\JsonContent(ref="#/components/schemas/Book")
     *    ),
     *
     *    @OA\Response(response="400", description="Requisição com erro",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Bad Request")
     *      )
     *    ),
     *    @OA\Response(response="401", description="Proibido",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Forbidden Error")
     *      )
     *    ),
     *    @OA\Response(response="403", description="Não autorizado",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Unauthorized Error")
     *      )
     *    ),
     *    @OA\Response(response="500", description="Erro interno",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Internal server error")
     *      )
     *    ),
     *
     * ),
     *
     * @param  CreateBookRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(CreateBookRequest $request)
    {
        $viewModel = $this->useCase->execute(new CreateBookRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_CREATED);
    }
}
