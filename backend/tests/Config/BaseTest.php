<?php

use PHPUnit\Framework\Attributes\CoversClass;
use IntruderAlert\Config\Base;

#[CoversClass(Base::class)]
class BaseTest extends AbstractTestCase
{
    public function setUp(): void
    {
        // Unset environment variables before each test
        putenv('IA_TEST');
    }

    /**
     * Test `isEnvBoolean`
     */
    public function testIsEnvBoolean(): void
    {
        putenv('IA_TEST=true');

        $class = new class () extends Base {
        };
        $this->assertTrue($class->isEnvBoolean('TEST'));
    }

    /**
     * Test `getEnv`
     */
    public function testGetEnv(): void
    {
        putenv('IA_TEST=Hello World');

        $class = new class () extends Base {
        };
        $this->assertEquals('Hello World', $class->getEnv('TEST'));
    }

    /**
     * Test `getEnv` with no environment variable
     */
    public function testGetEnvEmptyValue(): void
    {
        $class = new class () extends Base {
        };
        $this->assertEquals('', $class->getEnv('TEST_1'));
    }
}
