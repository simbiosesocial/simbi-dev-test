<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\ListAllAuthors\ListAllAuthorsUseCase;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListAllAuthorsController extends Controller
{
    /**
     * @param ListAllAuthorsUseCase $useCase
     */
    public function __construct(private ListAllAuthorsUseCase $useCase)
    {
    }

    /**
     * Lista todos os autores cadastrados.
     *
     * @OA\Get(
     *    path="/api/authors",
     *    summary="Lista todos os autores cadastrados na API",
     *    tags={"Authors"},
     *
     *    @OA\Response(
     *      response=200,
     *      description="Authors list",
     *      @OA\JsonContent(
     *        type="array",
     *        @OA\Items(
     *            @OA\Property(
     *              property="id",
     *              type="string",
     *              example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344",
     *            ),
     *            @OA\Property(
     *              property="name",
     *              type="string",
     *              example="Maria Carolina de Jesus",
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
