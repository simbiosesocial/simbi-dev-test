<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{CreateLoanRequestModel, CreateLoanUseCase};
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateLoanRequest;
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
     *    path="/api/loans", 
     *    summary="Cria um novo empréstimo",
     *    tags={"Loans"},
     *
     *    @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="book_id", type="string", format="uuid", example="2b819edb-6f16-3c3d-92b5-f589f9865ae6", description="ID do livro que está sendo emprestado."),
     *        @OA\Property(property="loan_date", type="string", format="date", example="2024-09-22", description="Data do início do empréstimo."),
     *        @OA\Property(property="return_date", type="string", format="date", example="2024-09-29", description="Data de devolução do livro."),
     *      )
     *    ),
     *
     *    @OA\Response(
     *      response=201,
     *      description="Empréstimo criado com sucesso",
     *      @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="id", type="string", example="cd835db9-5f40-4c37-8995-ddafd0e328c9", description="ID do empréstimo."),
     *        @OA\Property(
     *          property="loaned_book",
     *          type="object",
     *          @OA\Property(property="title", type="string", example="O palhaço e o psicanalista", description="Título do livro emprestado."),
     *          @OA\Property(property="publisher", type="string", example="Editora Paidós", description="Editora do livro."),
     *          @OA\Property(
     *            property="author",
     *            type="object",
     *            @OA\Property(property="id", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344", description="ID do autor."),
     *            @OA\Property(property="name", type="string", example="Christian Dunker", description="Nome do autor."),
     *          ),
     *          @OA\Property(property="createdAt", type="string", example="2022-12-14T22:24:26+00:00", description="Data de criação do registro."),
     *          @OA\Property(property="updatedAt", type="string", example="2022-12-14T22:24:26+00:00", description="Data da última atualização do registro."),
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
     * 
     */
    
    public function __invoke(CreateLoanRequest $request)
    {
        $viewModel = $this->useCase->execute(new CreateLoanRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_CREATED);
    }
}
