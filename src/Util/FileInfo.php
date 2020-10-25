<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Util;

class FileInfo
{
	private ?string $filename = null;

	private ?string $url = null;

	public function getFilename(): ?string
	{
		return $this->filename;
	}

	public function setFilename(?string $filename): self
	{
		$this->filename = $filename;

		return $this;
	}

	public function getUrl(): ?string
	{
		return $this->url;
	}

	public function setUrl(?string $url): self
	{
		$this->url = $url;

		return $this;
	}
}
