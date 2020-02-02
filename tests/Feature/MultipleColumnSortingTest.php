<?php

namespace musa11971\SortRequest\Tests\Feature;

use musa11971\SortRequest\Tests\TestCase;

class MultipleColumnSortingTest extends TestCase
{
    /** @test */
    function it_can_sort_using_two_columns()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'stackSize(asc), displayName(desc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_can_sort_using_three_columns()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'id(asc), stackSize(asc), displayName(desc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }
}