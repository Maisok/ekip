<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test successful registration.
     *
     * @return void
     */public function testSuccessfulRegistration()
{
    $userData = [
        'name' => $this->faker->name,
        'email' => $this->faker->unique()->safeEmail,
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'phone_number' => '89123456789',
    ];

    $response = $this->post(route('register'), $userData);

    $response->assertRedirect('/');

    // Проверка, что пользователь аутентифицирован
    $this->assertAuthenticated();

    // Проверка, что пользователь создан в базе данных
    $this->assertDatabaseHas('users', [
        'email' => $userData['email'],
        'phone_number' => $userData['phone_number'],
    ]);
}

public function testRegistrationWithExistingEmail()
{
    $existingUser = User::factory()->create();

    $userData = [
        'name' => $this->faker->name,
        'email' => $existingUser->email,
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'phone_number' => '89123456789',
    ];

    $response = $this->post(route('register'), $userData);

    $response->assertRedirect();
    $response->assertSessionHasErrors('email');
    $this->assertGuest();
}

public function testRegistrationWithExistingPhoneNumber()
{
    $existingUser = User::factory()->create();

    $userData = [
        'name' => $this->faker->name,
        'email' => $this->faker->unique()->safeEmail,
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'phone_number' => $existingUser->phone_number,
    ];

    $response = $this->post(route('register'), $userData);

    $response->assertRedirect();
    $response->assertSessionHasErrors('phone_number');
    $this->assertGuest();
}
}