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
     *        @OA\Items(ref="#/components/schemas/Book")
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
