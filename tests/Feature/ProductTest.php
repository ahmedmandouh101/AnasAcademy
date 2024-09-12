<?php

test('example', function () {
    $response = $this->post('/api/products', $data);
    $response->assertStatus(201);

    $response = $this->post('/login', $credentials);
    $response->assertStatus(302);

});
