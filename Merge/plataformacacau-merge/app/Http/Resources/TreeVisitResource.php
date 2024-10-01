<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TreeVisitResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$data =  [
			'id' => $this->id,
			'bobbin' => new BobbinResource($this->bobbin),
			'small' => new SmallResource($this->small),
			'medium' => new MediumResource($this->medium),
			'medium2' => $this->medium2,
			'medium3' => $this->medium3,
			'adult' => new AdultResource($this->adult),
			'adult2' => new AdultResource($this->adult2),
			'mature' => new MatureResource($this->mature),
			'mature2' => new MatureResource($this->mature2),
			'mature3' => new MatureResource($this->mature3),
			'mature4' => new MatureResource($this->mature4),
			'total_good' => $this->bobbin->total + $this->small->total +
				$this->medium->total + $this->medium2->total + $this->medium3->total +
				$this->adult->total + $this->adult2->total + $this->mature->total +
				$this->mature2->total + $this->mature3->total + $this->mature4->total,
			'total_wb' => $this->small->witchs_broom +
				$this->medium2->witchs_broom + $this->medium3->witchs_broom +
				$this->adult->witchs_broom + $this->adult2->witchs_broom +
				$this->mature->witchs_broom + $this->mature2->witchs_broom +
				$this->mature3->witchs_broom + $this->mature4->witchs_broom,
			'total_loss' => $this->small->loss +
				$this->medium->loss + $this->medium2->loss + $this->medium3->loss +
				$this->adult->loss + $this->adult2->loss + $this->mature->loss +
				$this->mature2->loss + $this->mature3->loss + $this->mature4->loss,
			'total_piece' => $this->small->piece + $this->medium->piece +
				$this->medium2->piece + $this->medium3->piece,
			'total_rotten' => $this->medium2->rotten +
				$this->medium3->rotten + $this->adult->rotten + $this->adult2->rotten +
				$this->mature->rotten + $this->mature2->rotten + $this->mature3->rotten +
				$this->mature4->rotten,
			'total_rat' => $this->medium2->rat + $this->medium3->rat +
				$this->adult->rat + $this->adult2->rat + $this->mature->rat +
				$this->mature2->rat + $this->mature3->rat + $this->mature4->rat,
			'total_harvested' => $this->medium3->harvested + $this->adult->harvested +
				$this->adult2->harvested + $this->mature->harvested +
				$this->mature2->harvested + $this->mature3->harvested +
				$this->mature4->harvested,
			'created_at' => $this->created_at,
			'date' => $this->date,
		];

		if (!$request->is('*/app')) {
			$data['tree'] = $this->tree;
			$data['collector'] = new UserResource($this->collector);
			$data['geolocation'] = new GeolocationResource($this->geolocation);
			$data['property'] = new PropertyResource($this->tree->sampling_point()->first()->property);
			$data['updated_at'] = $this->updated_at;
		}

		return $data;
	}
}
