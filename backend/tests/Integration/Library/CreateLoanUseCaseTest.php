<?php

namespace Tests\Integration\Library;

use App\Adapters\Presenters\Library\CreateLoanJsonPresenter;
use App\Core\Domain\Library\Exceptions\BookNotFound;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanRequestModel;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanUseCase;
use App\Core\Services\Library\CreateLoanService;
use App\Infra\Adapters\Persistence\Eloquent\Models\Author;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\BookEloquentRepository;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateLoanUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CreateLoanUseCase $useCase;
    private Book $book;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new CreateLoanService(
            output: new CreateLoanJsonPresenter(),
            loanRepository: new LoanEloquentRepository(),
            bookRepository: new BookEloquentRepository()
        );
        $this->book = Book::first() ?? Book::factory()->create();
    }

    public function testShouldCreateALoanWhenDatesAreNotProvided()
    {
        $request = new CreateLoanRequestModel([
            "bookId" => $this->book->id,
        ]);

        $loan = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertIsString($loan['id']);
        $this->assertEquals($this->book->id, $loan['book']['id']);
        $this->assertArrayHasKey('loanDate', $loan);
        $this->assertArrayHasKey('returnDate', $loan);
        $this->assertEquals('active', $loan['status']);

        $today = new DateTime('now');
        $returnDate = (clone $today)->modify('+7 days');
        $this->assertEquals($today->format(DateTime::ATOM), $loan['loanDate']);
        $this->assertEquals($returnDate->format(DateTime::ATOM), $loan['returnDate']);
    }

    public function testShouldCreateALoanWhenOnlyLoanDateIsProvided()
    {
        $today = new DateTime('now');
        $loanDate = $today->format(DateTime::ATOM);
        $request = new CreateLoanRequestModel([
            "bookId" => $this->book->id,
            "loanDate" => $loanDate,
        ]);

        $loan = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertIsString($loan['id']);
        $this->assertEquals($this->book->id, $loan['book']['id']);
        $this->assertArrayHasKey('loanDate', $loan);
        $this->assertArrayHasKey('returnDate', $loan);
        $this->assertEquals('active', $loan['status']);
        $this->assertEquals($loanDate, $loan['loanDate']);

        $returnDate = (clone $today)->modify('+7 days')->format(DateTime::ATOM);
        $this->assertEquals($returnDate, $loan['returnDate']);
    }

    public function testShouldCreateALoanWhenDatesAreProvided()
    {
        $today = new DateTime('now');
        $loanDate = $today->format(DateTime::ATOM);
        $returnDate = (clone $today)->modify('+14 days')->format(DateTime::ATOM);

        $request = new CreateLoanRequestModel([
            "bookId" => $this->book->id,
            "loanDate" => $loanDate,
            "returnDate" => $returnDate,
        ]);

        $loan = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertIsString($loan['id']);
        $this->assertEquals($this->book->id, $loan['book']['id']);
        $this->assertArrayHasKey('loanDate', $loan);
        $this->assertArrayHasKey('returnDate', $loan);
        $this->assertEquals('active', $loan['status']);

        $this->assertEquals($returnDate, $loan['returnDate']);
    }

    public function testShouldThrowLoanMustHaveABook()
    {
        $request = new CreateLoanRequestModel([
            "bookId" => "",
        ]);

        $this->expectException(LoanMustHaveABook::class);
        $this->useCase->execute($request);
    }

    public function testShouldThrowBookNotFound()
    {
        $invalidBookId = Uuid::uuid4();
        $request = new CreateLoanRequestModel([
            "bookId" => $invalidBookId,
        ]);

        $this->expectException(BookNotFound::class);
        $this->useCase->execute($request);
    }

}
