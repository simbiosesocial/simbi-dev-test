<?php

namespace Tests\Integration\Library;

use App\Adapters\Presenters\Library\CreateAuthorJsonPresenter;
use App\Core\Domain\Library\Exceptions\InvalidAuthorName;
use App\Core\Domain\Library\Ports\UseCases\CreateAuthor\CreateAuthorRequestModel;
use App\Core\Domain\Library\Ports\UseCases\CreateAuthor\CreateAuthorUseCase;
use App\Core\Services\Library\CreateAuthorService;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\AuthorEloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAuthorUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CreateAuthorUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new CreateAuthorService(
            output: new CreateAuthorJsonPresenter(),
            authorRepository: new AuthorEloquentRepository(),
        );
    }

    public function testShouldCreateAuthor()
    {
        $request = new CreateAuthorRequestModel([
            "firstName" => "Teste",
            "lastName" => "de Autor",
        ]);

        $author = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertIsString($author->id);
        $this->assertEquals("Teste de Autor", $author->name);
    }

    public function testShouldThrowInvalidAuthorName()
    {
        $request = new CreateAuthorRequestModel([
            "firstName" => "Teste",
        ]);

        $this->expectException(InvalidAuthorName::class);
        $this->useCase->execute($request);
    }
}
