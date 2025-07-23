<?php

declare(strict_types=1);

namespace Tests\Unit\Core;

use App\Core\Csrf;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CsrfTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION = [];
    }

    #[Test]
    public function itGeneratesTokenIfNotExists(): void
    {
        $token = Csrf::token();

        $this->assertNotEmpty($token);
        $this->assertEquals($token, $_SESSION['_csrf']);
    }

    #[Test]
    public function itReturnsExistingToken(): void
    {
        $_SESSION['_csrf'] = 'fixed_token';

        $token = Csrf::token();

        $this->assertEquals('fixed_token', $token);
    }
}
