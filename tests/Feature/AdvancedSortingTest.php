<?php

namespace musa11971\SortRequest\Tests\Feature;

use musa11971\SortRequest\Tests\TestCase;

class AdvancedSortingTest extends TestCase
{
    /** @test */
    function it_can_sort_a_custom_column()
    {
        $response = $this->json('GET', '/items/advanced', [
            'sort' => 'weight(light)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_can_sort_a_custom_and_normal_column_at_the_same_time()
    {
        $response = $this->json('GET', '/items/advanced', [
            'sort' => 'weight(light),id(desc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_cannot_sort_a_custom_column_with_invalid_direction()
    {
        $response = $this->json('GET', '/items/advanced', [
            'sort' => 'weight(super-heavy)'
        ]);

        $response->assertJsonValidationErrors(['sort']);
    }

    /** @test */
    function it_cannot_sort_a_custom_column_twice()
    {
        $response = $this->json('GET', '/items/advanced', [
            'sort' => 'weight(light),weight(heavy)'
        ]);

        $response->assertJsonValidationErrors(['sort']);
    }
}