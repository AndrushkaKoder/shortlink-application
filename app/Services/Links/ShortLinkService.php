<?php

namespace App\Services\Links;

class ShortLinkService
{
	use LinkRequestTrait;

	public function make(string $link): ?array
	{
		$linksObject = $this->request($link);
		if ($linksObject) {
			return [
				'long_url' => $linksObject->long_url,
				'short_url' => $linksObject->short_url
			];
		}
		return null;
	}

}