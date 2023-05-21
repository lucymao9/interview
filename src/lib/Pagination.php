<?php
namespace App\lib;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\QueryBuilder;

class Pagination extends Paginator
{
    public int $page;
    public int $perPage;
    public \ArrayIterator $datas;

	public function __construct(QueryBuilder $query,int $page=1,int $perPage=10,bool $fetchJoinCollection = true){
		$this->page=$page;
		$this->perPage=$perPage;
		$query->setFirstResult(($page-1)*$perPage)
        ->setMaxResults($perPage);
		parent::__construct($query, $fetchJoinCollection);
        $this->datas=$this->getIterator();
	}

	public function toArray() : array
	{
		return [
			'data'=>$this->datas,
            'pagination'=>[
                'page'=>$this->page,
                'perPage'=>$this->perPage,
                'total'=>$this->count(),
            ]
		];

	}
}