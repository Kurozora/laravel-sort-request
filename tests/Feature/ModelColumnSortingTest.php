<?php

namespace kiritokatklian\SortRequest\Tests\Feature;

use Illuminate\Support\Str;
use kiritokatklian\SortRequest\Tests\TestCase;

class ModelColumnSortingTest extends TestCase
{
    /** @test */
    function it_can_sort_a_models_integer_column_ascending()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'stackSize(asc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_can_sort_a_models_integer_column_descending()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'stackSize(desc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_can_sort_a_models_string_column_ascending()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'displayName(asc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_can_sort_a_models_string_column_descending()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'displayName(desc)'
        ]);

        $this->assertMatchesJsonSnapshot($response->json());
    }

    /** @test */
    function it_cannot_sort_a_models_column_that_is_not_sortable()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'gameName(asc)'
        ]);

        $response->assertJsonValidationErrors(['sort']);
    }

    /** @test */
    function it_cannot_sort_a_models_column_with_an_invalid_direction()
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
    function it_cannot_sort_the_same_model_column_more_than_once()
    {
        $response = $this->json('GET', '/items', [
            'sort' => 'id(asc),id(desc)'
        ]);

        $response->assertJsonValidationErrors(['sort']);
    }

    /** @test */
    function it_allows_the_user_to_omit_the_sorting_parameter()
    {
        $response = $this->json('GET', '/items');

        $response->assertSuccessful();
    }
}
