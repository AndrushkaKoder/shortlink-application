<?php

namespace App\Services\Links;

use GuzzleHttp\Client;

trait LinkRequestTrait
{
	public function request(string $url)
	{
		$client = new Client();
		$request = $client->post(config('linkservice', 'url'), [
			'headers' => $this->getHeaders(),
			'json' => $this->getRequestBody($url),
		]);

		$response = $request->getBody();
		return json_decode($response->getContents());
	}

	private function getHeaders(): array
	{
		$token = config('linkservice', 'token');
		return [
			'Authorization' => "Bearer {$token}",
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
		];
	}

	private function getRequestBody(string $link): array
	{
		return [
			'long_url' => $link,
			'domain' => 'https://t.ly/',
			'expire_at_datetime' => '2035-01-17 15:00:00',
			'description' => 'link',
			'public_stats' => true,
		];
	}

}