<?php

namespace App\Controller;

use App\Entity\TestUsers;
use App\Request\TestUsers\FindRequest;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestUsersController extends AbstractController
{
    #[Route(
        '/testusers/{id}', 
        name: 'get_test_users', 
        methods: ['GET'],
    )]
    public function get(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $user = $doctrine->getRepository(TestUsers::class)->find($id);
        return $this->json($user);
    }

    #[Route(
        '/testusers', 
        name: 'find_test_users', 
        methods: ['GET']
    )]
    public function find(ManagerRegistry $doctrine, FindRequest $findRequest): JsonResponse
    {
        //validate
        if($err = $findRequest->getErrorMessage()) return $err;
        $request = $findRequest->getRequest();
        $condition=[];
        $condition['isActive'] = $request->get('isActive');
        $condition['isMember'] = $request->get('isMember');
        $condition['lastLoginAtFrom'] = $request->get('lastLoginAtFrom');
        $condition['lastLoginAtTo'] = $request->get('lastLoginAtTo');
        $condition['userType'] = $request->get('userType');
        $condition['page'] = $request->get('page')?:1;
        $condition['perPage'] = $request->get('perPage')?:10;
        $TestUsers = $doctrine->getRepository(TestUsers::class)->findByCondition($condition);
        return $this->json($TestUsers);
    }
}
