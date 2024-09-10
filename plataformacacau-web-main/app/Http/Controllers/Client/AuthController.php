<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

class AuthController extends BaseController
{
	public function index()
	{
		return view('auth.login');
	}

	public function signup()
	{
		$user = Auth::user();

		if ($user) {
			return redirect()->route('panel');
		}

		return view('auth.signup');
	}

	public function login(Request $request)
	{
		$login_req = Request::create(
			$this->api_version_url . 'login',
			'POST',
			$request->all()
		);

		$response = Route::dispatch($login_req);
		$response = json_decode($response->getContent(), true);

		if (array_key_exists('success', $response) && !$response['success']) {
			return response()->json(['error' => 'Usuário não autorizado'], 401);
		}

		return redirect()->route('panel')
			->cookie('token', $response['access_token'], $response['expires_in']);
	}

	public function register(Request $request)
	{
		$user = Auth::user();

		if ($user) {
			return redirect()->route('panel');
		}

		$signup_req = Request::create(
			$this->api_version_url . 'signup',
			'POST',
			$request->all()
		);

		$response = Route::dispatch($signup_req);
		$response = json_decode($response->getContent(), true);

		if (array_key_exists('success', $response) && !$response['success']) {
			return response()->json([
				'error' => 'Erro no cadastro do usuário', 
				'message' => 
					$response['detail'] ? [$response['detail']] : []
			], 401);
		}

		// return response()->json(['message' => 'Dados de cadastro', 'data' => $request->all()]);
		return $response;
	}

	public function change_password(Request $request)
	{
		$request = Request::create(
			$this->api_version_url . 'change-password',
			'POST',
			$request->all()
		);
		$request->headers->set('token', $request->cookie('token'));

		$response = Route::dispatch($request);

		if (!$response) {
			return response()->json(['message' => 'Usuário não autorizado']);
		}

		return $response;
	}

	public function logout(Request $request)
	{
		$logout_req = Request::create(
			$this->api_version_url . 'logout',
			'GET',
			['token' => $request->cookie('token')]
		);
		$response = Route::dispatch($logout_req);

		if (!$response) {
			return response()->json(['message' => 'Falha ao tentar sair.']);
		}

		Cookie::queue(Cookie::forget('token'));

		return redirect()->route('home');
	}

	public function me(Request $request)
	{
		$logout_req = Request::create(
			$this->api_version_url . 'me',
			'GET',
			['token' => $request->cookie('token')]
		);
		$response = Route::dispatch($logout_req);

		if (!$response) {
			return response()->json(['message' => 'Falha ao tentar sair.']);
		}

		return response()->json($response);
	}
}
