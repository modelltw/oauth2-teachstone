<?php

namespace Teachstone\OAuth2\Client\Provider;

use League\OAuth2\Client\Entity\User;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Provider\AbstractProvider;

class Teachstone extends AbstractProvider
{
  public $authorizationHeader = 'OAuth';

  public $baseUrl = '';

  public function urlAuthorize()
  {
    return $this->$baseUrl . '/oauth/authorize';
  }

  public function urlAccessToken()
  {
    return $this->$baseUrl . '/oauth/token';
  }

  public function urlUserDetails(AccessToken $token)
  {
    return $this->$baseUrl . '/me?access_token=' . $token;
  }

  public function userDetails($response, AccessToken $token)
  {
    $response = (array) $response;

    $user = new User();

    $user->exchangeArray([
      'uid' => $response['guid'],
      'name' => $response['first_name'] . ' ' . $response['last_name'],
      'firstname' => $response['first_name'],
      'lastname' => $response['last_name'],
      'email' => $response['email'],
    ]);

    return $user;
  }

}
