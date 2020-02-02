<?php

namespace musa11971\SortRequest\Tests\Feature;

use Illuminate\Support\Str;
use musa11971\SortRequest\Tests\TestCase;

class InvalidSortingTest extends TestCase
{
    /** @test */
    function it_cannot_sort_a_column_that_is_not_sortable()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'gameName(asc)'
        ]);

        $response->assertJsonValidationErrors(['sort']);
    }

    /** @test */
    function it_cannot_sort_a_column_with_an_invalid_direction()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'displayName(best)'
        ]);

        $response->assertJsonValidationErrors(['sort']);
    }

    /** @test */
    function it_cannot_sort_with_a_gibberish_string()
    {
        $response = $this->json('GET', '/items', [
            'sort' => Str::random(20)
        ]);

        $response->assertJsonValidationErrors(['sort']);
    }

    /** @test */
    function it_cannot_sort_the_same_column_more_than_once()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'id(asc),id(desc)'
        ]);

        $response->assertJsonValidationErrors(['sort']);
    }
}