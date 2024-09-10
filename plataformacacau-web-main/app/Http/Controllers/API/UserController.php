<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Permission;
use App\Role;
use App\Models\HomogeneousArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @group Gerenciamento de Usuários
 *
 * @authenticated
 *
 * Endpoints e funções para gerenciamento de usuários
 *
 * @apiResourceCollection App\Http\Resources\UserResource
 * @apiResourceModel App\Models\User
 */
class UserController extends BaseController
{
	protected $messages = [
		'name.required' => 'Nome inválido',
		'cpf.required' => 'CPF inválido',
		'email.required' => 'Email inválido',
		'password.required' => 'Senha inválida',
		'status.required' => 'Status inválido',
		'roles.required' => 'Necessário selecionar pelo menos um papel para o usuário',
		'permissions.required' => 'Necessário selecionar pelo menos uma permissão para o usuário',
	];

	/**
	 * Exibe todos os usuários
	 *
	 * @responseFile responses/users/index.json
	 * @responseFile 404 responses/404.json
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user_id = Auth::id();
		$is_admin = $this->is_admin();
		$is_farmer = $this->is_farmer();
		$is_user_manager = $this->is_users_manager();

		if ($is_admin) {
			$users = User::orderBy('id', 'asc')->get();
		} else if ($is_farmer) {
			$user = User::find($user_id);
			$users = $user->employees;
		} else if ($is_user_manager) {
			$boss = DB::table('users_employees')
				->where('employee_id', '=', $user_id)
				->first();
			$boss_id = $boss->user_id;
			$user = User::find($boss_id);
			$users = $user->employees->where('label', '!=', 'admin')->where('id', '!=', $user_id);
		} else {
			$users = User::whereHas(
				'roles',
				function ($roles) {
					$roles->where('label', '!=', 'admin');
				}
			)
				->orderBy('id', 'asc')
				->get();
		}

		return $this->send_response(UserResource::collection($users));
	}

	/**
	 * Exibe todos os papeis do sistema caso seja administrador. Caso contrário, mostrará todos exceto o administrador.
	 *
	 * @responseFile responses/users/all_roles.json
	 * @responseFile 404 responses/404.json
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all_roles()
	{
		$is_admin = $this->is_admin();
		if ($is_admin) {
			$roles = Role::all();
		} else {
			$roles = Role::where('label', '!=', 'admin')->get();
		}

		return $this->send_response(RoleResource::collection($roles));
	}


	/**
	 * Exibe todas as permissões do sistema
	 *
	 * @responseFile responses/users/all_permissions.json
	 * @responseFile 404 responses/404.json
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all_permissions()
	{
		$permissions = Permission::all();

		return $this->send_response(PermissionResource::collection($permissions));
	}

	/**
	 * Cria um novo usuário
	 *
	 * @bodyParam name string required Nome do usuário. Example: Jagunço Fernandes
	 * @bodyParam cpf string required CPF do usuário. Example: 027.478.854-14
	 * @bodyParam email string required Email do usuário. Example: jaguncofernan@gmail.com
	 * @bodyParam password string required Senha do usuário. Example: jagunco123
	 * @bodyParam password_confirmation string required Confirmação da senha do usuário.
	 * @bodyParam status bool required Status atual do usuário (ativo: 1 ou inativo: 0). Example: 1
	 * @bodyParam roles array required Papéis do usuário dentro do sistema. No-example
	 * @bodyParam permissions array required Permissões do usuário dentro do sistema. No-example
	 *
	 * @responseFile responses/users/store.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validate = array(
			'name' => 'required|string|max:255',
			'cpf' => 'required|string|unique:users',
			'phone' => 'required|string',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8|max:100',
			'status' => 'required',
			'roles' => 'required',
			// 'permissions' => 'required'
		);

		$validator = Validator::make($request->all(), $validate, $this->messages);

		if ($validator->fails()) {
			return $this->send_error(
				'Erro ao tentar cadastrar o usuário',
				$validator->errors()
			);
		}

		$is_admin = $this->is_admin();
		$is_farmer = $this->is_farmer();
		$user_id = Auth::id();

		$user = new User();
		$user->name = $request->get('name');
		$user->phone = $request->get('phone');
		$user->email = $request->get('email');
		$user->status = $request->get('status');
		$user->cpf = $user->cpf_formatter($request->get('cpf'));
		$user->password = Hash::make($request->get('password'));
		$user->save();

		if ($is_admin || $is_farmer) {
			$boss = User::find($user_id);

			$boss->employees()->attach($user->id);
		} else {
			$boss = DB::table('users_employees')
				->where('employee_id', '=', $user_id)
				->first();
			$boss = User::find($boss->user_id);

			$boss->employees()->attach($user->id);
		}

		if (in_array(1, $request->roles)) {
			$user->roles()->attach(Role::all()
				->pluck('id')->toArray());
		} else {
			$user->roles()->attach($request->roles);
		}

		// attach sampling points to collector
		if (in_array(7, $request->roles)) {
			$user->sampling_points()->attach($request->sampling_points_id);
			foreach ($request->homogeneous_areas_id as $id) {
				$homogeneous_area = HomogeneousArea::find($id);
				$homogeneous_area->collector()->associate($user)->save();
			}
		}

		return $this->send_response(
			new UserResource($user),
			'Usuário cadastrado com sucesso',
			201
		);
	}

	/**
	 * Exibe um usuário específico
	 *
	 * @queryParam user required Identificador único do usuário. Example: 1
	 *
	 * @responseFile responses/users/show.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		if (!$user) {
			$this->send_error('Usuário não encontrado');
		}

		return $this->send_response(new UserResource($user));
	}

	/**
	 * Atualiza um usuário específico
	 *
	 * @queryParam user required Identificador único do usuário. Example: 1
	 *
	 * @bodyParam name string required Nome do usuário. Example: Jagunço Fernandes
	 * @bodyParam cpf string required CPF do usuário. Example: 027.478.854-14
	 * @bodyParam email string required Email do usuário. Example: jaguncofernan@gmail.com
	 * @bodyParam password string required Senha do usuário. Example: jagunco123
	 * @bodyParam password_confirmation string required Confirmação da senha do usuário.
	 * @bodyParam status bool required Status atual do usuário (ativo: 1 ou inativo: 0). Example: 0
	 * @bodyParam roles array required Papéis do usuário dentro do sistema (ex.: 1 = Usuário, 2 = Coletador, 3 = Administrador). Example: 3
	 *
	 * @responseFile responses/users/update.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		if (!$user) {
			$this->send_error('Usuário não encontrado');
		}

		if ($request->password) {
			$user->password = Hash::make($request->password);
		}

		$user->name = $request->get('name');
		$user->phone = $request->get('phone');
		$user->cpf = $user->cpf_formatter($request->get('cpf'));
		$user->email = $request->get('email');
		$user->status = $request->get('status');
		$user->homogeneous_areas()->update(['user_id' => null]);
		$user->update();

		$user->roles()->sync($request->roles);

		// attach sampling points to collector
		if (in_array(7, $request->roles)) {
			$user->sampling_points()->sync($request->sampling_points_id);
			foreach ($request->homogeneous_areas_id as $id) {
				$homogeneous_area = HomogeneousArea::find($id);
				$homogeneous_area->collector()->associate($user)->save();
			}
		} else {
			$user->sampling_points()->detach($request->sampling_points_id);
			foreach ($request->homogeneous_areas_id as $id) {
				$homogeneous_area = HomogeneousArea::find($id);
				$homogeneous_area->collector()->dissociate()->save();
			}
		}

		return $this->send_response(
			new UserResource($user),
			'Usuário atualizado'
		);
	}

	/**
	 * Desativa ou ativa um usuário específico
	 *
	 * @queryParam user required Identificador único do usuário. Example: 3
	 *
	 * @responseFile responses/users/deactivate.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function status(Request $request, User $user)
	{
		if ($request->status) {
			$user->status = true;
			$user->update();

			return $this->send_response(
				new UserResource($user),
				'Usuário ativado',
				200
			);
		}

		$user->status = false;
		$user->update();

		return $this->send_response(
			new UserResource($user),
			'Usuário desativado',
			200
		);
	}

	protected function is_admin()
	{
		$roles = auth('api')->user()
			->roles()
			->where('label', 'admin')
			->get()
			->toArray();

		$is_admin = count($roles) ? true : false;

		return $is_admin;
	}

	public function is_farmer()
	{
		$roles = auth('api')->user()
			->roles()
			->where('label', 'pre-registered')
			->get()
			->toArray();

		$is_farmer = count($roles) ? true : false;

		return $is_farmer;
	}

	public function is_users_manager()
	{
		$roles = auth('api')->user()
			->roles()
			->where('label', 'users-manager')
			->get()
			->toArray();

		$is_users_manager = count($roles) ? true : false;

		return $is_users_manager;
	}
}
