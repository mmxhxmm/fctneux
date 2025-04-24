<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Mail\UserResetEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class MailerTest extends TestCase
{
   /**
    * A basic unit test example.
    *
    * @return void
    */
   public function testSending()
   {
        Mail::fake();

        $user = new User(['name' => 'Test User', 'email' => 'test@example.com', 'situacion' => 'alta', 'municipio' => 'Barcelona']);

        Mail::send(new UserResetEmail($user));

        Mail::assertSent(UserResetEmail::class);
   }
}