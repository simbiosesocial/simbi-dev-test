<?php

namespace Tests\Integration\Library;

use App\Adapters\Presenters\Library\ListAllLoansJsonPresenter;
use App\Core\Domain\Library\Ports\UseCases\ListAllLoans\ListAllLoansUseCase;
use App\Core\Services\Library\ListAllLoansService;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllLoansUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private ListAllLoansUseCase $useCase;
    private Book $book;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new ListAllLoansService(
            output: new ListAllLoansJsonPresenter(),
            loanRepository: new LoanEloquentRepository(),
        );
        $this->book = Book::first() ?? Book::factory()->create();
    }

    public function testShouldListAllLoans()
    {

        $loan = $this->useCase->execute()->resource->toArray(null);

        $this->assertIsString($loan->id);
        $this->assertEquals($this->book->id, $loan->book->id);
    }
}
