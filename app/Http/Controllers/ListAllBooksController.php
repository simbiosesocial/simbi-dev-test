<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\ListAllBooks\ListAllBooksUseCase;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListAllBooksController extends Controller
{
    /**
     * @param ListAllBooksUseCase $useCase
     */
    public function __construct(private ListAllBooksUseCase $useCase)
    {
    }

    /**
     * Lista todos os livros cadastrados.
     *
     * @OA\Get(
     *    path="/api/books",
     *    summary="Lista todos os livros cadastrados na API",
     *    tags={"Books"},
     *
     *    @OA\Response(
     *      response=200,
     *      description="Books list",
     *      @OA\JsonContent(
     *        type="array",
     *        @OA\Items(
     *            @OA\Property(
     *              property="id",
     *              type="string",
     *              example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344",
     *            ),
     *            @OA\Property(
     *              property="title",
     *              type="string",
     *              example="Curso avançado de Java",
     *            ),
     *            @OA\Property(
     *              property="publisher",
     *              type="string",
     *              example="Editora XPTO",
     *            ),
     *            @OA\Property(
     *              property="author",
     *              type="object",
     *              @OA\Property(property="id", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344"),
     *              @OA\Property(property="name", type="string", example="Autor Y"),
     *            ),
     *            @OA\Property(
     *              property="createdAt",
     *              type="string",
     *              example="2022-12-14T22:24:26+00:00",
     *            ),
     *            @OA\Property(
     *              property="updatedAt",
     *              type="string",
     *              example="2022-12-14T22:24:26+00:00",
     *            ),
     *        )
     *      ),
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
     * @return JsonResponse
     */
    public function __invoke()
    {
        $viewModel = $this->useCase->execute();
        return response()->json($viewModel->getResponse(), Response::HTTP_OK);
    }
}
