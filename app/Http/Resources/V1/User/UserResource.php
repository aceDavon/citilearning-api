<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\V1\Course\CourseResource;
use App\Http\Resources\V1\Invoice\InvoiceResource;
use App\Http\Resources\V1\Subscription\SubscriptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'phone' => $this->phone,
            'username' => $this->username,
            'address' => $this->address,
            'invoices' => InvoiceResource::collection($this->whenLoaded('invoices')),
            'courses' => CourseResource::collection($this->whenLoaded('courses')),
            'subscriptions' => SubscriptionResource::collection($this->whenLoaded('subscriptions'))
        ];
    }
}
