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

    public function testCanFollow(){
      $user = factory(User::class)->create();
      $other = factory(User::class)->create();

      $response = $this->actingAs($user)->post($other->username . '/follow');

      $this->assertDatabaseHas('followers', [
        'user_id' => $user->id,
        'followed_id' => $other->id,
      ]);
    }
}
