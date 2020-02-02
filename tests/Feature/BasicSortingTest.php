<?php

namespace musa11971\SortRequest\Tests\Feature;

use musa11971\SortRequest\Tests\TestCase;

class BasicSortingTest extends TestCase
{
    /** @test */
    function it_can_sort_basic_integer_columns_ascending()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'stackSize(asc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_can_sort_basic_integer_columns_descending()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'stackSize(desc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_can_sort_basic_string_columns_ascending()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'displayName(asc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_can_sort_basic_string_columns_descending()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'displayName(desc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }
}