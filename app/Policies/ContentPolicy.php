<?php

namespace App\Policies;

use App\Client;
use App\Content;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function edit(Client $client, Content $content)
    {
        // If user is administrator, then can edit any post
        if ($client->parent_id == 0 && $content->client_id == $client->id) {
            return true;
        }

        // Check if user is the post author
        if ($client->parent_id != 0 && $content->created_by == $client->id) {
            return true;
        }

        return false;
    }
    public function view(Client $client, Content $content)
    {
        // If user is administrator, then can edit any post
        if ($client->parent_id == 0 && $content->client_id == $client->id) {
            return true;
        }

        // Check if user is the post author
        if ($client->parent_id != 0 && $content->created_by == $client->id) {
            return true;
        }

        return false;
    }
}
