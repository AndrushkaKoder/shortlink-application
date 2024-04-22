<?php

namespace App\Controllers;

use App\Models\Link;
use App\Services\Links\ShortLinkService;
use GuzzleHttp\Client;
use Kernel\Controller\BaseController;

class IndexController extends BaseController
{
	public function index(): void
	{
		$this->view->page('home', ['user' => $this->auth->user()]);
	}

	public function store(): bool|int
	{
		$json = json_decode(file_get_contents('php://input'));
		$id = $json->id;
		$lonLink = $this->validateLink($json->link);
		if ($id && $lonLink) {
			$links = $this->links($json->link);
			Link::query()
				->insert(
					array_merge($links, ['user_id' => $json->id])
				);
			return http_response_code(200);
		}
		return http_response_code(500);
	}

	public function links(string $longLink): ?array
	{
		if (!$this->validateLink($longLink)) return null;
		$linkService = new ShortLinkService();
		$links = $linkService->make($longLink);
		return $links ?? null;
	}

	public function getUserLinks(): ?string
	{
		$userId = $this->request->get('id');
		$links = Link::query()->select([], ['user_id' => $userId]);
		if ($links) {
			header('Content-Type: application/json');
			echo json_encode($links);
		}
		return null;
	}

	private function validateLink(string $link): bool
	{
		return str_contains($link, 'http');
	}

	public function logout(): void
	{
		$this->auth->logout();
	}


}