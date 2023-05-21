<?php
namespace App\Request\TestUsers;

use App\Request\AbstractRequest;
use Symfony\Component\Validator\Constraints as Assert;

class FindRequest extends AbstractRequest
{
	#[Assert\Choice([0,1])]
	protected int $isActive;

	#[Assert\Choice([0,1])]
	protected int $isMember;

	#[Assert\DateTime]
	protected string $lastLoginAtFrom;

	#[Assert\DateTime]
	protected string $lastLoginAtTo;

	//just example. choice should depends on needs
	#[Assert\Choice(choices:[1,2,3,4],multiple:true)]
	protected array $userType;

	public function preHandle(): array
	{
		return [
			'userType'=>function($userType){
				if(!$userType) return [];
				if(!is_array($userType)) $userType=[$userType];
				return array_map(function($value){
					return intval($value);
				}, $userType);
			}
		];
	}
}