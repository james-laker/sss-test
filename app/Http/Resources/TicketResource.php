<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $this->load('user');
        return [
            'ID' => $this->id,
            'Subject' => $this->subject,
            'Content' => $this->content,
            'Status' => $this->status ? 'Closed' : 'Open',
            'Created By' => $this->user->name,
            'email' => $this->user->email,
            'Last Updated' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
