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
     *        required={"firstName","lastName"},
     *        @OA\Property(property="title", type="string"),
     *        @OA\Property(property="publisher", type="string"),
     *        @OA\Property(property="authorId", type="string"),
     *      )
     *    ),
     *
     *    @OA\Response(
     *      response=201,
     *      description="Book Created",
     *      @OA\JsonContent(
     *        type="object",
     *        @OA\Property(
     *          property="id",
     *          type="string",
     *          example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344",
     *        ),
     *        @OA\Property(
     *          property="title",
     *          type="string",
     *          example="Curso avançado de Java",
     *        ),
     *        @OA\Property(
     *          property="publisher",
     *          type="string",
     *          example="Editora XPTO",
     *        ),
     *        @OA\Property(
     *          property="author",
     *          type="object",
     *          @OA\Property(property="id", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344"),
     *          @OA\Property(property="name", type="string", example="Autor Y"),
     *        ),
     *        @OA\Property(
     *          property="createdAt",
     *          type="string",
     *          example="2022-12-14T22:24:26+00:00",
     *        ),
     *        @OA\Property(
     *          property="updatedAt",
     *          type="string",
     *          example="2022-12-14T22:24:26+00:00",
     *        ),
     *      )
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
