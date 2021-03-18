<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;

class PlayerAssignment implements PlayerAssignmentInterface
{
	private static array $playerAssignmentTypes = [
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_TD,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PASSER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_RECEIVER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_RUSHER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_RECEIVER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_RUSHER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_SACK,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_INTERCEPTION,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_INTERCEPTION,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PUNT_RETURNER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_PUNT_RETURNER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_KICKOFF_RETURNER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_KICKOFF_RETURNER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PUNTER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_KICKER,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_OWN_KICKOFF_RECOVERY,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_BLOCKED,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_TACKLE_FOR_LOSS,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_QB_HIT,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FORCED_FUMBLE,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_SOLO_TACKLE,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_TACKLE_WITH_ASSIST,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PASS_DEFENSE,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FUMBLED,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FUMBLE_RECOVERY,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PENALTY,
		PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FANTASY
	];

	protected ?int $id = null;

	protected ?string $type = null;

	protected ?Player $player = null;

	protected ?int $yards = null;

	protected ?int $orderNumber = null;

	protected ?Play $play = null;

	public function __construct()
	{
		$this->player = new Player();
		$this->play = new Play();
	}

	public static function getPlayerAssignmentTypes(): array
	{
		return self::$playerAssignmentTypes;
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

	public function getPlayer(): ?Player
	{
		return $this->player;
	}

	public function setPlayer(?Player $player): self
	{
		$this->player = $player;

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
