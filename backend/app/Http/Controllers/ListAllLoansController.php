<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\ListAllLoans\ListAllLoansUseCase;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListAllLoansController extends Controller
{
    /**
     * @param ListAllLoansUseCase $useCase
     */
    public function __construct(private ListAllLoansUseCase $useCase)
    {
    }

    /**
     * Lista todos os empréstimos cadastrados.
     *
     * @OA\Get(
     *    path="/api/books",
     *    summary="Lista todos os empréstimos cadastrados na API",
     *    tags={"Loans"},
     *
     *    @OA\Response(
     *      response=200,
     *      description="Loans list",
     *     @OA\JsonContent(
     *        type="object",
     *        @OA\Property(
     *          property="id",
     *          type="string",
     *          example="31c35de6-4d7f-65a7-2da9-8abcf3c44357",
     *        ),
     *        @OA\Property(
     *          property="bookId",
     *          type="string",
     *          example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344",
     *        ),
     *        @OA\Property(
     *          property="loanDate",
     *          type="string",
     *          example="2022-12-14",
     *        ),
     *        @OA\Property(
     *          property="returnDate",
     *          type="string",
     *          example="2022-12-21",
     *        ),
     *        @OA\Property(
     *          property="lastRenewedAt",
     *          type="string",
     *          example="2022-12-21",
     *        ),
     *        @OA\Property(
     *          property="renewalCount",
     *          type="number",
     *          example=0,
     *        ),
     *        @OA\Property(
     *          property="status",
     *          type="string",
     *          example="active",
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
