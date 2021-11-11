<?php

// framework/test.php
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testHello()
    {
        $data = http_build_query([
            'name' => 'Fabien',
        ]);

        // Open the file using the HTTP headers set above
        $content = file_get_contents("http://localhost:8080?$data");

        $this->assertEquals('Hello Fabien', $content);
    }
}
