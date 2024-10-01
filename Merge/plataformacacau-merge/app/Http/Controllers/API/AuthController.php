<?php

namespace App\Http\Controllers\API;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * @group Autenticação de Usuários
 * 
 * Endpoints e funções para autenticação de usuários
 */
class AuthController extends BaseController
{
	use ResetsPasswords, SendsPasswordResetEmails {
		SendsPasswordResetEmails::broker insteadof ResetsPasswords;
		ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
	}

	protected $messages = [
		'name.required' => 'Você deve informar um nome válido',
		'email.required' => 'Você deve informar um email válido',
		'email.unique' => 'O email já está sendo usado por outro usuário',
		'password.required' => 'Você deve informar uma senha válida',
		'password.unique' => 'O telefone já está sendo usado por outro usuário',
		'phone.required' => 'Você deve informar um telefone válido',
	];

	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth:api', ['except' => ['login']]);
	}

	/**
	 * Obtém um JWT por meio de credenciais fornecidas
	 * 
	 * @bodyParam name string required Email do usuário. Example: adrielfabricios@gmail.com
	 * @bodyParam passowrd string required Senha do usuário. Example: adrielfabricio
	 * 
	 * @responseFile responses/auth/login.json
	 *
	 * @param Request $request 
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');
		$token = auth('api')->attempt($credentials);

		if (!$token) {
			return $this->send_error('Usuário não autorizado', null, 401);
		}

		return $this->response_with_token($token);
	}

	public function register(Request $request)
	{
		$pre_registered_role = Role::where('label', 'pre-registered')->first();

		$validate = [
			'name' => 'required|string',
			'email' => 'required|string|unique:users',
			'phone' => 'required|string|unique:users',
			'password' => 'required|string|min:8',
		];

		$validator = Validator::make($request->all(), $validate, $this->messages);

		if ($validator->fails()) {
			return $this->send_error(
				'Erro ao tentar cadastrar o usuário',
				$validator->errors()
			);
		}

		$user = new User();
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->phone = $user->phone_formatter($request->get('phone'));
		$user->password = Hash::make($request->get('password'));
		$user->status = 1;
		$user->save();

		$user->roles()->attach($pre_registered_role);

		return $this->send_response(
			new UserResource($user),
			'Usuário cadastrado com sucesso',
			201
		);
	}

	/**
	 * Obtém os dados do usuário autenticado
	 *
	 * @authenticated
	 * 
	 * @bodyParam token string required Token JWT do usuário atual. Example: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1OTMxNTM4NzcsImV4cCI6MTU5MzE1NzQ3NywibmJmIjoxNTkzMTUzODc3LCJqdGkiOiJVTnI1bDZnS3BZTDFiV2FaIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.XsjJhEWyVF9jpkYIfy2ouSJRwK1sQas6GxP99InaR7s
	 * 
	 * @responseFile responses/auth/me.json
	 * 
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		return response()->json(auth('api')->user());
	}

	/**
	 * Desconecta o usuário (invalida o token)
	 *
	 * @authenticated
	 * 
	 * @responseFile responses/auth/logout.json
	 * 
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth('api')->logout();

		return response()->json([
			'message' => 'Successfully logged out'
		]);
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh()
	{
		return $this->response_with_token(auth('api')->refresh());
	}

	/**
	 * Altera senha atual do usuário
	 * 
	 * @bodyParam current_password Senha atual do usuário
	 * @bodyParam new_password Nova senha do usuário
	 * @bodyParam new_password_confirmation Confirmação da nova senha
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function change_password(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'current_password' => 'required',
			'new_password' => 'required|confirmed',
		]);

		$user = User::find(auth('api')->user()->id);

		if (!(Hash::check($request->get('current_password'), $user->password))) {
			return $this->send_error(
				'Senha atual errada.',
				'Caso não se lembre da senha, por favor solicite uma nova'
			);
		} else if (strcmp(
			$request->get('current_password'),
			$request->get('new_password')
		) == 0) {
			return $this->send_error(
				'Senhas são iguais.',
				'A nova senha não pode ser a mesma que a senha antiga. Por favor escolha outra.'
			);
		}

		if ($validator->fails()) {
			return $this->send_error('Erro ao tentar atualizar a senha');
		}

		User::find(auth('api')->user()->id)->update([
			'password' => Hash::make($request->new_password)
		]);

		return $this->send_response(
			null,
			'Senha alterada com sucesso'
		);
	}

	/**
	 * Envia link para alteração de senha
	 * 
	 * @bodyParam email required Email do usuário. Example: adrielfabricios@gmail.com
	 * 
	 * @response Email com o link para alteração de senha
	 * @response 404 Email inválido
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return void
	 */
	public function send_password_reset_link(Request $request)
	{
		return $this->sendResetLinkEmail($request);
	}

	/**
	 * Altera a senha do usuário
	 * 
	 * @bodyParam password Nova senha do usuário
	 * @bodyParam password_confirmation Confirmação da nova senha
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return void
	 */
	public function call_reset_password(Request $request)
	{
		$this->reset($request);
	}

	/**
	 * Get the response for a successful password reset link.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetLinkResponse(Request $request, $response)
	{
		return $this->send_response(
			$response,
			'Email successfully sent.'
		);
	}
	/**
	 * Get the response for a failed password reset link.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetLinkFailedResponse(Request $request, $response)
	{
		return $this->send_error(
			'Email could not be sent to this email address.'
		);
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
	 * @param  string  $password
	 * @return void
	 */
	protected function resetPassword(User $user, $password)
	{
		$user->password = Hash::make($password);
		$user->save();

		event(new PasswordReset($user));
	}

	/**
	 * Get the response for a successful password reset.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetResponse(Request $request, $response)
	{
		return $this->send_response($response, 'Password reset successfully.');
	}

	/**
	 * Get the response for a failed password reset.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	protected function sendResetFailedResponse(Request $request, $response)
	{
		return $this->send_error('Failed, Invalid Token.', $response);
	}
}
