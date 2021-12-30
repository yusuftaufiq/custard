<?php

namespace Tests\Application\TodoList;

use App\Models\TodoList;
use PHPUnit\Framework\TestCase;
use Tests\Application\MockHelper;
use Tests\Application\ValidatorHelper;
use App\Http\Controllers\TodoListController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateTodoListTest extends TestCase
{
    use MockHelper;
    use ValidatorHelper;

    final public function testUpdateAnTodoList(): void
    {
        $expectedData = [
            'title' => 'Building beautiful world...',
            'is_active' => true,
        ];

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($expectedData));
        $request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->will($this->returnValue(TodoList::init()->random()?->id));

        $todoList = new TodoListController();
        $response = $todoList->update($request);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->assertSame($content?->status, 'Success');
        $this->assertIsObject($content?->data);

        $this->assertObjectHasAttribute('id', $content?->data);
        $this->assertSame($expectedData['title'], $content?->data?->title);
        $this->assertEquals((bool) $expectedData['is_active'], $content?->data?->is_active);
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
        $request
            ->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue([]));

        $todoList = new TodoListController();
        $todoList->update($request);
    }
}
