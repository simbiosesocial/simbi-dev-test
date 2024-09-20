<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\DeleteLoanById\{DeleteLoanByIdRequestModel, DeleteLoanByIdUseCase};
use App\Http\Requests\DeleteLoanByIdRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteLoanByIdController extends Controller
{
    public function __construct(private DeleteLoanByIdUseCase $useCase)
    {
    }

    /**
     * Permite remove um empréstimo através do seu ID
     *
     * @OA\Delete(
     *    path="/api/loan",
     *    summary="Deleta um empréstimo a partir do ID",
     *    tags={"Loans"},
     *
     *    @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="loan_id", type="string"),
     *      )
     *    ),
     *
     *    @OA\Response(
     *      response=200,
     *      description="Loan Deleted",
     *      @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="id", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344"),
     *        @OA\Property(
     *          property="loaned_book",
     *          type="object",
     *          @OA\Property(property="title", type="string", example="O Príncipe"),
     *          @OA\Property(property="publisher", type="string", example="Editora XPTO"),
     *          @OA\Property(
     *            property="author",
     *            type="object",
     *            @OA\Property(property="id", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344"),
     *            @OA\Property(property="name", type="string", example="Nicolau Maquiavel"),
     *          ),
     *          @OA\Property(property="createdAt", type="string", example="2022-12-14T22:24:26+00:00"),
     *          @OA\Property(property="updatedAt", type="string", example="2022-12-14T22:24:26+00:00"),
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
     * @param  DeleteLoanByIdRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(DeleteLoanByIdRequest $request)
    {
        $viewModel = $this->useCase->execute(new DeleteLoanByIdRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_CREATED);
    }
}