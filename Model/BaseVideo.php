<?php

namespace meedi\VideoBundle\Model;

use meedi\VideoBundle\Providers\IVideoProvider;

class BaseVideo {
	
	protected $video_id;

	protected $title;

	protected $description;

	protected $duration;

	protected $thumbPath;

	protected $provider;

	public function __construct()
	{
	}

	public function setVideoId($video_id)
	{
		$this->video_id = $video_id;

		return $this;
	}

	public function getVideoId()
	{
		return $this->video_id;
	}

	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDuration($duration)
	{
		$this->duration = intval($duration);

		return $this;
	}

	public function getDuration()
	{
		return $this->duration;
	}

	public function setProvider(IVideoProvider $provider)
	{
		$this->provider = $provider;

		return $this;
	}

	public function getProvider()
	{
		return $this->provider;
	}

	public function setThumbPath($path)
	{
		$this->thumbPath = $path;

		return $this;
	}

	public function getThumbPath()
	{
		return $this->thumbPath;
	}
}
