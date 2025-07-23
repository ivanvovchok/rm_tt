<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Lang;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionProperty;

class LangTest extends TestCase
{
    protected ReflectionClass $ref;
    protected ReflectionProperty $langProp;

    #[Test]
    public function returnsValueIfKeyExists(): void
    {
        $this->langProp->setValue(null, ['greeting' => 'Hello']);

        $result = Lang::get('greeting');

        $this->assertEquals('Hello', $result);
    }

    #[Test]
    public function returnsKeyIfKeyDoesNotExist(): void
    {
        $this->langProp->setValue(null, ['only_this' => 'ok']);

        $result = Lang::get('missing_key');

        $this->assertEquals('missing_key', $result);
    }

    protected function setUp(): void
    {
        $this->ref      = new ReflectionClass(Lang::class);
        $this->langProp = $this->ref->getProperty('lang');
        $this->langProp->setAccessible(true);
        $this->langProp->setValue(null, null);
    }
}
