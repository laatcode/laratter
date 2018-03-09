<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    public function testCanLogin()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
          'email' => $user->email,
          'password' => 'secret'
        ]);

        $this->assertAuthenticatedAs($user);
    }
}
