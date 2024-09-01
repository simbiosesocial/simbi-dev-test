<?php

namespace Tests\Integration\Library;

use App\Adapters\Presenters\Library\CreateBookJsonPresenter;
use App\Core\Domain\Library\Exceptions\AuthorNotFound;
use App\Core\Domain\Library\Exceptions\BookMustHaveAnAuthor;
use App\Core\Domain\Library\Exceptions\BookMustHaveAPublisher;
use App\Core\Domain\Library\Exceptions\BookMustHaveATitle;
use App\Core\Domain\Library\Ports\UseCases\CreateBook\CreateBookRequestModel;
use App\Core\Domain\Library\Ports\UseCases\CreateBook\CreateBookUseCase;
use App\Core\Services\Library\CreateBookService;
use App\Infra\Adapters\Persistence\Eloquent\Models\Author;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\AuthorEloquentRepository;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\BookEloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateBookUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CreateBookUseCase $useCase;
    private Author $author;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new CreateBookService(
            output: new CreateBookJsonPresenter(),
            bookRepository: new BookEloquentRepository(),
            authorRepository: new AuthorEloquentRepository(),
        );
        $this->author = Author::first() ?? Author::factory()->create();
    }

    public function testShouldCreateABook()
    {

        $request = new CreateBookRequestModel([
            "title" => "Book-Title",
            "publisher" => "Book-Publisher",
            "authorId" => $this->author->id,
        ]);

        $book = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertIsString($book['id']);
        $this->assertEquals("Book-Title", $book['title']);
        $this->assertEquals("Book-Publisher", $book['publisher']);
        $this->assertEquals($this->author->id, $book['author']['id']);
    }

    public function testShouldThrowBookMustHaveATitle()
    {
        $request = new CreateBookRequestModel([
            "publisher" => "Book-Publisher",
            "authorId" => $this->author->id,
        ]);

        $this->expectException(BookMustHaveATitle::class);

        $this->useCase->execute($request);
    }

    public function testShouldThrowBookMustHaveAPublisher()
    {
        $request = new CreateBookRequestModel([
            "title" => "Book-Title",
            "authorId" => $this->author->id,
        ]);

        $this->expectException(BookMustHaveAPublisher::class);
        $this->useCase->execute($request);
    }

    public function testShouldThrowBookMustHaveAnAuthor()
    {
        $request = new CreateBookRequestModel([
            "title" => "Book-Title",
            "publisher" => "Book-Publisher",
        ]);

        $this->expectException(BookMustHaveAnAuthor::class);
        $this->useCase->execute($request);
    }

    public function testShouldThrowAuthorNotFound()
    {
        $invalidAuthorId = Uuid::uuid4();
        $request = new CreateBookRequestModel([
            "title" => "Book-Title",
            "publisher" => "Book-Publisher",
            "authorId" => $invalidAuthorId,
        ]);

        $this->expectException(AuthorNotFound::class);
        $this->useCase->execute($request);
    }
}
