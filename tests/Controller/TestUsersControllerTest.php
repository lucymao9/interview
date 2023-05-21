<?php
declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestUsersControllerTest extends WebTestCase
{

    public function testFind(): void
    {
        $client = static::createClient();
        // $client->request('GET', '/test/users');
        // $this->assertResponseIsSuccessful();

        $client->request('GET', '/testusers',[
            'isActive'=>3
        ]);
        $this->assertResponseStatusCodeSame(201);

        $client->request('GET', '/testusers',[
            'isMember'=>3
        ]);
        $this->assertResponseStatusCodeSame(201);


        $client->request('GET', '/testusers',[
            'lastLoginAtFrom'=>'21:22:11'
        ]);
        $this->assertResponseStatusCodeSame(201);

        $client->request('GET', '/testusers',[
            'lastLoginAtTo'=>'21:22:11'
        ]);
        $this->assertResponseStatusCodeSame(201);

        $client->request('GET', '/testusers',[
            'userType'=>8
        ]);
        $this->assertResponseStatusCodeSame(201);

        $client->request('GET', '/testusers',[
            'isActive'=>1,
            'isMember'=>0,
            'userType'=>[1,2],
            'lastLoginAtFrom'=>'2020-02-05 12:34:13',
            'page'=>1,
            'perPage'=>20,
        ]);
        $response = $client->getResponse();
        $responseArray = json_decode($response->getContent(),true);
        $this->assertArrayHasKey('data', $responseArray);
        $this->assertArrayHasKey('pagination', $responseArray);
        $this->assertCount(20, $responseArray['data']);
    }
}
