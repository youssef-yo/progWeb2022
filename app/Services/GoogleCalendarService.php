<?php

namespace App\Services;

use Google\Client;

class GoogleCalendarService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect_uri'));
        $this->client->setScopes(config('services.google.scopes'));
        $this->client->setAccessType(config('services.google.access_type'));
        // ... altre configurazioni dell'oggetto client
    }

    public function getClient()
    {
        return $this->client;
    }
}