<?php

use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\assertTrue;

it('should render the register page', function () {
    $response = get('/auth/cadastro');
    $body = $response->getBody();

    expect($response->getStatusCode())->toBe(Response::HTTP_OK);
    assertTrue(str_contains($body->getContents(), 'Crie a sua conta'));
});
