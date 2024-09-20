<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{CreateLoanRequestModel, CreateLoanUseCase};
use App\Http\Requests\CreateLoanRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateLoanController extends Controller
{
    public function __construct(private CreateLoanUseCase $useCase)
    {
    }

    /**
     * Permite adicionar um novo empréstimo
     *
     * @OA\Post(
     *    path="/api/loan",
     *    summary="Cria um novo empréstimo",
     *    tags={"Loans"},
     *
     *    @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="book_id", type="string"),
     *        @OA\Property(property="start_loan_date", type="string"),
     *        @OA\Property(property="end_loan_date", type="string"),
     *      )
     *    ),
     *
     *    @OA\Response(
     *      response=201,
     *      description="Loan Created",
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
     * @param  CreateLoanRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(CreateLoanRequest $request)
    {
        $viewModel = $this->useCase->execute(new CreateLoanRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_CREATED);
    }
}