<?php

namespace Tests\Application\TodoList;

use App\Http\Controllers\TodoListController;
use App\Models\TodoList;
use PHPUnit\Framework\TestCase;
use Tests\Application\MockHelper;
use Tests\Application\ValidatorHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteTodoListTest extends TestCase
{
    use MockHelper;
    use ValidatorHelper;

    final public function testDeleteAnTodoList(): void
    {
        $expectedData = TodoList::init()->random();

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->will($this->returnValue($expectedData?->id));

        $todoList = new TodoListController();
        $response = $todoList->destroy($request);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->assertSame($content?->status, 'Success');
    }

    final public function testTodoListNotFound(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Todo with ID 0 Not Found');

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->will($this->returnValue(0));

        $todoList = new TodoListController();
        $todoList->destroy($request);
    }
}
