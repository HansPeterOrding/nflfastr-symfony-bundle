<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;

class TeamAssignment implements TeamAssignmentInterface
{
	private static array $teamAssignmentTypes = [
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_DEFENSE,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FORCED_FUMBLE,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FUMBLE_RECOVERY,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FUMBLED,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_PENALTY,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_POSESSION,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_RETURN,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_SOLO_TACKLE,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_TACKLE_WITH_ASSIST,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_TIMEOUT,
		TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_TOUCHDOWN
	];

	protected ?int $id = null;
	
	protected ?string $type = null;

	protected ?Team $team = null;

	protected ?int $yards = null;

	protected ?int $orderNumber = null;

	protected ?Play $play = null;

	public function __construct()
	{
		$this->team = new Team();
		$this->play = new Play();
	}

	public static function getTeamAssignmentTypes(): array
	{
		return self::$teamAssignmentTypes;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): self
	{
		$this->id = $id;

		return $this;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function setType(?string $type): self
	{
		$this->type = $type;

		return $this;
	}

	public function getTeam(): ?Team
	{
		return $this->team;
	}

	public function setTeam(?Team $team): self
	{
		$this->team = $team;

		return $this;
	}

	public function getYards(): ?int
	{
		return $this->yards;
	}

	public function setYards(?int $yards): self
	{
		$this->yards = $yards;

		return $this;
	}

	public function getOrderNumber(): ?int
	{
		return $this->orderNumber;
	}

	public function setOrderNumber(?int $orderNumber): self
	{
		$this->orderNumber = $orderNumber;

		return $this;
	}

	public function getPlay(): ?Play
	{
		return $this->play;
	}

	public function setPlay(?Play $play): self
	{
		$this->play = $play;

		return $this;
	}
}
