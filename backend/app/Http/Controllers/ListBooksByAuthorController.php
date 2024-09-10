<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\ListBooksByAuthor\{ListBooksByAuthorRequestModel, ListBooksByAuthorUseCase};
use App\Http\Requests\ListBooksByAuthorRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListBooksByAuthorController extends Controller
{
    /**
     * @param ListBooksByAuthorUseCase $useCase
     */
    public function __construct(private ListBooksByAuthorUseCase $useCase)
    {
    }
    /**
     * Lista todos os livros cadastrados por um determinado autor.
     *
     * @OA\Get(
     *    path="/api/authors/{id}/books",
     *    summary="Lista todos os livros cadastrados na API para um determinado autor",
     *    tags={"Authors"},
     *
     *    @OA\Parameter(
     *      name="id",
     *      in="path",
     *      schema={"type": "string", "default": "2234f840-417e-4944-ac9b-e7e6eb06c590"},
     *      description="ID do autor",
     *      required=true,
     *    ),
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
     *    @OA\Response(response=404, description="Não encontrado",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Resource Not Found Error")
     *      )
     *     ),
     *    @OA\Response(response="500", description="Erro interno",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Internal server error")
     *      )
     *    ),
     *
     * ),
     *
     * @param  ListBooksByAuthorRequest  $request
     *
     * @return JsonResponse
     */
    public function __invoke(ListBooksByAuthorRequest $request)
    {
        $viewModel = $this->useCase->execute(new ListBooksByAuthorRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_OK);
    }
}
