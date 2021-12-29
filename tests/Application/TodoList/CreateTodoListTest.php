<?php

namespace Tests\Application\TodoList;

use App\Http\Controllers\TodoListController;
use PHPUnit\Framework\TestCase;
use Tests\Application\MockHelper;
use Tests\Application\ValidatorHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateTodoListTest extends TestCase
{
    use MockHelper;
    use ValidatorHelper;

    final public function testStoreAnTodoList(): void
    {
        $expectedData = [
            'title' => 'Create something beautiful',
            'activity_group_id' => 1,
        ];

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($expectedData));

        $todoList = new TodoListController();
        $response = $todoList->store($request);

        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->validateResultIsSuccess($content);
        $this->assertIsObject($content?->data);

        $this->assertObjectHasAttribute('id', $content?->data);
        $this->assertSame($expectedData['title'], $content?->data?->title);
        $this->assertEquals($expectedData['activity_group_id'], $content?->data?->activity_group_id);
        $this->assertObjectHasAttribute('is_active', $content?->data);
        $this->assertObjectHasAttribute('priority', $content?->data);
        $this->assertObjectHasAttribute('created_at', $content?->data);
        $this->assertObjectHasAttribute('updated_at', $content?->data);
        $this->assertObjectHasAttribute('deleted_at', $content?->data);
    }

    final public function testBadRequestStoreAnTodoList(): void
    {
        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('"activity_group_id" cannot be null');

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue([
                'title' => 'Foo Bar!',
            ]));

        $todoList = new TodoListController();
        $todoList->store($request);
    }
}
