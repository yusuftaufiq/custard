<?php

namespace Tests\Application\TodoList;

use App\Http\Controllers\TodoListController;
use App\Models\TodoList;
use PHPUnit\Framework\TestCase;
use Tests\Application\MockHelper;
use Tests\Application\ValidatorHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowTodoListTest extends TestCase
{
    use MockHelper;
    use ValidatorHelper;

    final public function testShowAllTodoLists(): void
    {
        $expectedData = TodoList::init()->all();

        $request = $this->getMockRequest();

        $todoList = new TodoListController();
        $response = $todoList->index($request);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->assertSame($content?->status, 'Success');
        $this->assertIsArray($content?->data);
        $this->assertEquals($expectedData, $content?->data);
    }

    final public function testShowAnTodoList(): void
    {
        $expectedData = TodoList::init()->random();

        $request = $this->getMockRequest();

        $todoList = new TodoListController();
        $response = $todoList->show($request, $expectedData?->id);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->assertSame($content?->status, 'Success');
        $this->assertIsObject($content?->data);
        $this->assertEquals($expectedData, $content?->data);
    }

    final public function testTodoListNotFound(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Todo with ID 0 Not Found');

        $request = $this->getMockRequest();

        $todoList = new TodoListController();
        $todoList->show($request, 0);
    }
}
