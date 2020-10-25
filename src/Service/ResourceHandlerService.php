<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Service;

use HansPeterOrding\NflFastrSymfonyBundle\Exception\ResourceHandlingException;
use HansPeterOrding\NflFastrSymfonyBundle\Util\FileInfo;
use Iterator;
use League\Csv\Reader;
use League\Flysystem\FilesystemInterface;

class ResourceHandlerService
{
	private const DEFAULT_DELIMITER = ',';
	private const DEFAULT_ENCLOSURE = '"';

	private const ROSTER_FILE_PREFIX = 'roster_';
	private const ROSTER_FILE_SUFFIX = '';

	private const PLAYBYPLAY_FILE_PREFIX = 'play_by_play_';
	private const PLAYBYPLAY_FILE_SUFFIX = '.csv';

	private FilesystemInterface $temporaryLocalStorage;

	private iterable $sources;

	public function __construct(
		FilesystemInterface $temporaryLocalStorage,
		array $sources
	) {
		$this->temporaryLocalStorage = $temporaryLocalStorage;
		$this->sources = $sources;
	}

	public function buildRosterFileInfo(int $season): FileInfo
	{
		$fileInfo = new FileInfo();

		$fileInfo->setFilename(static::ROSTER_FILE_PREFIX . $season . self::ROSTER_FILE_SUFFIX);
		$fileInfo->setUrl(
			$this->sources['roster']['baseUrl']
			. $this->sources['roster']['path']
			. $fileInfo->getFilename()
			. '.csv'
		);

		return $fileInfo;
	}

	public function buildPlayByPlayFileInfo(int $season): FileInfo
	{
		$fileInfo = new FileInfo();

		$fileInfo->setFilename(static::PLAYBYPLAY_FILE_PREFIX . $season . self::PLAYBYPLAY_FILE_SUFFIX);
		$fileInfo->setUrl(
			$this->sources['playByPlay']['baseUrl']
			. $this->sources['playByPlay']['path']
			. $fileInfo->getFilename()
			. '.gz'
		);

		return $fileInfo;
	}

	public function extractGzipFromUrl(FileInfo $fileInfo): void
	{
		if ($this->temporaryLocalStorage->has($fileInfo->getFilename())) {
			$this->temporaryLocalStorage->delete($fileInfo->getFilename());
		}

		$gz = gzopen($fileInfo->getUrl(), 'rb');
		if (!$gz) {
			throw new ResourceHandlingException(sprintf('GZIP file at %s could not be loaded', $fileInfo->getUrl()));
		}

		$this->temporaryLocalStorage->writeStream($fileInfo->getFilename(), $gz);

		gzclose($gz);
	}

	public function readCsvFromTemporaryStorage(FileInfo $fileInfo): Iterator
	{
		$reader = Reader::createFromStream($this->temporaryLocalStorage->readStream($fileInfo->getFilename()));

		return $this->getRecordsFromReader($reader);
	}

	public function readCsvFromUrl(FileInfo $fileInfo): Iterator
	{
		$content = file_get_contents($fileInfo['url']);
		$reader = Reader::createFromString($content);

		return $this->getRecordsFromReader($reader);
	}

	private function getRecordsFromReader(Reader $reader): Iterator
	{
		$reader->setDelimiter(static::DEFAULT_DELIMITER);
		$reader->setEnclosure(static::DEFAULT_ENCLOSURE);
		$reader->setHeaderOffset(0);

		$this->foundRows = $reader->count();

		return $reader->getRecords();
	}
}
