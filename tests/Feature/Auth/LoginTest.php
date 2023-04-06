<?php

use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\assertTrue;

it('should render the login page', function () {
    $response = get('/auth/login');
    $body = $response->getBody();

    expect($response->getStatusCode())->toBe(Response::HTTP_OK);
    assertTrue(str_contains($body->getContents(), 'Faça login'));

    $response = get('/');
    $body = $response->getBody();

    expect($response->getStatusCode())->toBe(Response::HTTP_OK);
    assertTrue(str_contains($body->getContents(), 'Faça login'));
});
