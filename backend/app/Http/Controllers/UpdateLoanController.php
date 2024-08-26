<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\FinalizeLoan\FinalizeLoanRequestModel;
use App\Core\Domain\Library\Ports\UseCases\FinalizeLoan\FinalizeLoanUseCase;
use App\Core\Domain\Library\Ports\UseCases\RenewLoan\RenewLoanRequestModel;
use App\Core\Domain\Library\Ports\UseCases\RenewLoan\RenewLoanUseCase;
use App\Http\Requests\FinalizeLoanRequest;
use App\Http\Requests\RenewLoanRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateLoanController extends Controller
{
    /**
     * @param FinalizeLoanUseCase $finalizeUseCase
     */
    public function __construct(
        private FinalizeLoanUseCase $finalizeUseCase,
        private RenewLoanUseCase $renewUseCase
    ) {
        $this->finalizeUseCase = $finalizeUseCase;
        $this->renewUseCase = $renewUseCase;
    }
    /**
     * @OA\Patch(
     *     path="/api/loans/{id}/finalize",
     *     summary="Finaliza um empréstimo, com o retorno do livro.",
     *     tags={"Loans"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the loan to return",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Loan returned successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="string",
     *                 example="31c35de6-4d7f-65a7-2da9-8abcf3c44357"
     *             ),
     *             @OA\Property(
     *                 property="bookId",
     *                 type="string",
     *                 example="31c35de6-4d7f-65a7-2da9-8abcf3c44357"
     *             ),
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="finished"
     *             ),
     *             @OA\Property(
     *                 property="returnedAt",
     *                 type="string",
     *                 example="2023-10-01"
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(response="400", description="Requisição com erro",
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
     *    @OA\Response(
     *         response=404,
     *         description="Não encontrado",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Unauthorized Error")
     *      )
     *     ),
     *    @OA\Response(response="500", description="Erro interno",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Internal server error")
     *      )
     *    ),
     * )
     * @return JsonResponse
     */
    public function finalize(FinalizeLoanRequest $request)
    {
        $viewModel = $this->finalizeUseCase->execute(new FinalizeLoanRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_OK);
    }

    /**
     * @OA\Patch(
     *     path="/api/loans/{id}/renew",
     *     summary="Renova um empréstimo",
     *     tags={"Loans"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the loan to renew",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Loan renewed successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="string",
     *                 example="31c35de6-4d7f-65a7-2da9-8abcf3c44357"
     *             ),
     *              @OA\Property(
     *                 property="bookId",
     *                 type="string",
     *                 example="31c35de6-4d7f-65a7-2da9-8abcf3c44357"
     *             ),
     *             @OA\Property(
     *                 property="renewalCount",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="returnDate",
     *                 type="string",
     *                 example="2023-10-15"
     *             ),
     *             @OA\Property(
     *                 property="lastRenewedAt",
     *                 type="string",
     *                 example="2023-10-15"
     *             ),
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="active"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Loan not found"
     *     )
     * )
     * @return JsonResponse
     */
    public function renew(RenewLoanRequest $request)
    {
        $viewModel = $this->renewUseCase->execute(new RenewLoanRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_OK);
    }
}
