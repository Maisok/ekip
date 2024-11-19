<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string|unique:users',
            'g-recaptcha-response' => 'required',
        ]);
    
        // Проверка reCAPTCHA
        $client = new Client([
            'verify' => false, // Disable SSL verification
        ]);
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => '6Lc9BYEqAAAAAHy807C2BpwH7O-nqlIEEnDOyx0I',
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ],
        ]);
    
        $body = json_decode((string) $response->getBody());
    
        if (!$body->success) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.']);
        }
    
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'role' => 'user',
            ]);
    
            Auth::login($user);
    
            return redirect('/');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Код ошибки для дубликата записи
                return redirect()->back()->withErrors(['phone_number' => 'Номер телефона уже занят.']);
            }
            throw $e; // Если это другая ошибка, передаем ее дальше
        }
    }
}