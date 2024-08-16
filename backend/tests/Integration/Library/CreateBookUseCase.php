<?php

namespace Tests\Integration\Library;

use App\Core\Domain\Library\Ports\UseCases\CreateBook\CreateBookUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateBookUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CreateBookUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testShouldCreateABook()
    {
        $this->markTestIncomplete();
    }

    public function testShouldThrowBookMustHaveATitle()
    {
        $this->markTestIncomplete();
    }

    public function testShouldThrowBookMustHaveAPublisher()
    {
        $this->markTestIncomplete();
    }

    public function testShouldThrowBookMustHaveAnAuthor()
    {
        $this->markTestIncomplete();
    }
}
