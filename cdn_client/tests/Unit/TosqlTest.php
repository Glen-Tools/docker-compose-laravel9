<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\UserRepository;
use App\Models\User;

class TosqlTest extends TestCase
{


    /**
     *
     */
    public function testToSql()
    {
        $userRepo = new UserRepository(new User());
        var_dump($userRepo->testDbTooRawSql());
        var_dump($userRepo->testOrmtoRawSql());
        $this->assertTrue(true);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
}
