<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseController extends Controller
{
	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function response_with_token($token = null)
	{
		$response = [
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' =>
			auth('api')
				->factory()
				->getTTL()
		];

		return response()
			->json($response);
	}

	/**
	 * success response method.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function send_response($result, $message = null, $code = 200)
	{
		if (!empty($result['meta'])) {
			$response = [
				'success' => true,
				'data' => $result['data'],
				'meta' => $result['meta'],
				'message' => $message,
			];
		} else {
			$response = [
				'success' => true,
				'data' => $result,
				'message' => $message,
			];
		}

		return response()->json($response, $code);
	}


	/**
	 * return error response.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function send_error($error, $error_messages = [], $code = 404)
	{
		$response = [
			'success' => false,
			'message' => $error,
		];

		if (!empty($error_messages)) {
			$response['detail'] = $error_messages;
		}

		return response()->json($response, $code);
	}

	/**
	 * Gera a paginação dos itens de um array ou collection.
	 *
	 * @param array|Collection      $items
	 * @param int   $perPage
	 * @param int  $page
	 * @param array $options
	 *
	 * @return LengthAwarePaginator
	 */
	public function paginate($items, $perPage = 15, $page = null, $options = [])
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

		$items = $items instanceof Collection ? $items : Collection::make($items);

		$lap =  new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

		$data = $lap->values();
		$meta = [
			'current_page' => $lap->currentPage(),
			'first_page_url' => $lap->url(1),
			'from' => $lap->firstItem(),
			'last_page' => $lap->lastPage(),
			'last_page_url' => $lap->url($lap->lastPage()),
			'next_page_url' => $lap->nextPageUrl(),
			'per_page' => $lap->perPage(),
			'prev_page_url' => $lap->previousPageUrl(),
			'to' => $lap->lastItem(),
			'total' => $lap->total(),
		];

		$paginate_data = array(
			'data' => $data,
			'meta' => $meta
		);

		return $paginate_data;
	}
}
