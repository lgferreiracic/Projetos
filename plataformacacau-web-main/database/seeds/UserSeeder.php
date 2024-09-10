<?php

use App\Role;
use App\User;
use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// User::truncate();
		// Role::truncate();
		// Permission::truncate();

		$roles_title = [
			'Administrador',
			'Gerente de Áreas Homogêneas',
			'Gerente de Unidades Operacionais',
			'Gerente de Pontos Amostrais',
			'Gerente de Usuários',
			'Gerente de Propriedades',
			'Coletor',
			'Pré Registrado',
		];
		$roles_label = [
			'admin',
			'homogeneous_area-manager',
			'strata-manager',
			'sampling_points-manager',
			'users-manager',
			'properties-manager',
			'collector',
			'pre-registered',
		];

		$permissions_title = [
			'Criar Área Homogênea',
			'Atualizar Área Homogênea',
			'Ver Área Homogênea',
			'Desativar Área Homogênea',
			'Criar Unidade Operacional',
			'Atualizar Unidade Operacional',
			'Ver Unidade Operacional',
			'Desativar Unidade Operacional',
			'Criar Pontos Amostrais',
			'Atualizar Pontos Amostrais',
			'Ver Pontos Amostrais',
			'Desativar Pontos Amostrais',
			'Criar Coletores',
			'Atualizar Coletores',
			'Ver Coletores',
			'Desativar Coletores',
			'Criar Gerentes',
			'Atualizar Gerentes',
			'Ver Gerentes',
			'Desativar Gerentes',
			'Criar Árvores',
			'Atualizar Árvores',
			'Ver Árvores',
			'Desativar Árvores',
			'Enviar Dados',
			'Visualizar Dados'
		];

		$permissions_label = [
			'create-homogeneous_area',
			'update-homogeneous_area',
			'read-homogeneous_area',
			'deactivate-homogeneous_area',
			'create-strata',
			'update-strata',
			'read-strata',
			'deactivate-strata',
			'create-sampling_points',
			'update-sampling_points',
			'read-sampling_points',
			'deactivate-sampling_points',
			'create-users',
			'update-users',
			'read-users',
			'deactivate-users',
			'create-managers',
			'update-managers',
			'read-managers',
			'deactivate-managers',
			'create-trees',
			'update-trees',
			'read-trees',
			'deactivate-trees',
			'send-visit',
			'get-data',
		];

		for ($i = 0; $i < count($roles_label); $i++) {
			Role::create([
				'label' => $roles_label[$i],
				'title' => $roles_title[$i],
			]);
		}

		for ($i = 0; $i < count($permissions_label); $i++) {
			Permission::create([
				'label' => $permissions_label[$i],
				'title' => $permissions_title[$i],
			]);
		}

		// default permissions...
		$admin_role = Role::where('label', 'admin')->first();
		$admin_permissions = Permission::all();

		$homogeneous_area_manager_role = Role::where('label', 'homogeneous_area-manager')->first();
		$homogeneous_area_manager_permissions = Permission::where('label', 'like', '%-homogeneous_area')->get();

		$strata_manager_role = Role::where('label', 'strata-manager')->first();
		$strata_manager_permissions = Permission::where('label', 'like', '%-strata')->get();

		$sampling_points_manager_role = Role::where('label', 'sampling_points-manager')->first();
		$sampling_points_manager_permissions = Permission::where('label', 'like', '%-sampling_points')->get();

		$users_manager_role = Role::where('label', 'users-manager')->first();
		$users_manager_permissions = Permission::where('label', 'like', '%-users')->get();

		$properties_manager_role = Role::where('label', 'properties-manager')->first();
		$properties_manager_permissions = Permission::where('label', 'like', '%-properties')->get();

		$collector_role = Role::where('label', 'collector')->first();
		$collector_permissions = Permission::where('label', '=', 'send-visit',)
			->where('label', '=', 'get-data')->get();

		$pre_registered_role = Role::where('label', 'pre-registered')->first();
		$pre_registered_permissions = Permission::where('label', 'like', '%-properties')->get();

		// attach roles to permissions...
		$admin_role->permissions()->attach($admin_permissions);
		$strata_manager_role->permissions()->attach($homogeneous_area_manager_permissions);
		$homogeneous_area_manager_role->permissions()->attach($strata_manager_permissions);
		$sampling_points_manager_role->permissions()->attach($sampling_points_manager_permissions);
		$users_manager_role->permissions()->attach($users_manager_permissions);
		$properties_manager_role->permissions()->attach($properties_manager_permissions);
		$collector_role->permissions()->attach($collector_permissions);

		// manager users
		$manager = User::create([
			'name' => 'Martinha',
			'date_birth' => date('Y-m-d'),
			'cpf' => '92801382515',
			// 'email' => 'marta.uesc@gmail.com',
			'email' => 'mmdornelles@gmail.com',
			'password' => Hash::make('123456'),
			'phone' => '73988737480',
		]);
		$manager->roles()->attach($admin_role);
		$manager->permissions()->attach($admin_permissions);

		$manager2 = User::create([
			'name' => 'Christian',
			'date_birth' => date('Y-m-d'),
			'cpf' => '07749927514',
			'email' => 'christiannmenezes@gmail.com',
			'password' => Hash::make('christian'),
			'phone' => '73988737485',
		]);
		$manager2->roles()->attach($admin_role);
		$manager2->permissions()->attach($admin_permissions);

		// collectors users
		$collector1 = User::create([
			'name' => 'Coletor 1',
			'date_birth' => date('Y-m-d'),
			'cpf' => '41941767079',
			'email' => 'coletor1@gmail.com',
			'password' => Hash::make('123456'),
			'phone' => '73988737481',
		]);
		$collector1->roles()->attach($collector_role);
		$collector1->permissions()->attach($collector_permissions);

		$collector2 = User::create([
			'name' => 'Coletor 2',
			'date_birth' => date('Y-m-d'),
			'cpf' => '09590366015',
			'email' => 'coletor2@gmail.com',
			'password' => Hash::make('123456'),
			'phone' => '73988737482',
		]);
		$collector2->roles()->attach($collector_role);
		$collector2->permissions()->attach($collector_permissions);

		// farmer user 1
		$farmer = User::create([
			'name' => 'Juninho Portugal',
			'date_birth' => date('Y-m-d'),
			'cpf' => '03820790519',
			'email' => 'juporto@gmail.com',
			'password' => Hash::make('123456'),
			'phone' => '73988747675',
		]);
		$farmer->roles()->attach($pre_registered_role);
		$farmer->permissions()->attach($pre_registered_permissions);

		// farmer user 2
		$farmer = User::create([
			'name' => 'Márcia Fernandes',
			'date_birth' => date('Y-m-d'),
			'cpf' => '50956947000',
			'email' => 'mfernandes@gmail.com',
			'password' => Hash::make('123456'),
			'phone' => '73988747670',
		]);
		$farmer->roles()->attach($pre_registered_role);
		$farmer->permissions()->attach($pre_registered_permissions);
	}
}
