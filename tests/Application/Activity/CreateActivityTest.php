<?php

namespace Tests\Application\Activity;

use App\Http\Controllers\ActivityController;
use App\Models\Activity;
use PHPUnit\Framework\TestCase;
use Tests\Application\MockHelper;
use Tests\Application\ValidatorHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateActivityTest extends TestCase
{
    use MockHelper;
    use ValidatorHelper;

    final public function testStoreAnActivity(): void
    {
        $expectedData = [
            'title' => 'Create something beautiful',
        ];

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($expectedData));

        $activity = new ActivityController();
        $response = $activity->store($request);

        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->validateResultIsSuccess($content);
        $this->assertIsObject($content?->data);

        $this->assertObjectHasAttribute('id', $content?->data);
        $this->assertSame($expectedData['title'], $content?->data?->title);
        $this->assertObjectHasAttribute('email', $content?->data);
        $this->assertObjectHasAttribute('created_at', $content?->data);
        $this->assertObjectHasAttribute('updated_at', $content?->data);
        $this->assertObjectHasAttribute('deleted_at', $content?->data);
    }

    final public function testFailedStoreAnActivity(): void
    {
        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('"title" cannot be null');

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue([]));

        $activity = new ActivityController();
        $response = $activity->store($request);
    }
}
