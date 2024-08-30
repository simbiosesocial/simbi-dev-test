<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\CreateAuthor\{CreateAuthorRequestModel, CreateAuthorUseCase};
use App\Http\Requests\CreateAuthorRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CreateAuthorController extends Controller
{
    /**
     * @param CreateAuthorUseCase $useCase
     */
    public function __construct(private CreateAuthorUseCase $useCase)
    {
    }
    /**
     * Permite adicionar um autor
     *
     * @OA\Post(
     *    path="/api/authors",
     *    summary="Adiciona um novo autor na API",
     *    tags={"Authors"},
     *
     *    @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        type="object",
     *        required={"firstName","lastName"},
     *        @OA\Property(property="firstName", type="string"),
     *        @OA\Property(property="lastName", type="string"),
     *      )
     *    ),
     *
     *    @OA\Response(
     *      response=201,
     *      description="Author Created",
     *      @OA\JsonContent(ref="#/components/schemas/Author")
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
     * @param  CreateAuthorRequest  $request
     *
     * @return JsonResponse
     */
    public function __invoke(CreateAuthorRequest $request)
    {
        $viewModel = $this->useCase->execute(new CreateAuthorRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_CREATED);
    }
}
