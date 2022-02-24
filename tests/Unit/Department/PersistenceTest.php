<?php

use FruiVita\Corporate\Models\Department;
use Illuminate\Support\Str;

test('cadastra múltiplas departments (lotações)', function () {
    $amount = 30;

    Department::factory()
        ->count($amount)
        ->create();

    expect(Department::count())->toBe($amount);
})->only();

test('campo do department (lotação) em seu tamanho máximo é aceito', function ($field, $length) {
    Department::factory()->create([$field => Str::random($length)]);

    expect(Department::count())->toBe(1);
})->with([
    ['name', 255],
    ['acronym', 50],
]);
