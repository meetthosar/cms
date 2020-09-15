<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class PostTest extends TestCase
{
    /**
     * Post Listing
     * @test
     * @return void
     */
    public function check_post_listing_endoint()
    {
        $response = $this->get('/api/listing');

        $response->assertStatus(200);
    }

    /**
     * Search Posts
     * @test
     */
    public function check_post_search_endpoint(){
        $response = $this->post('/api/listing', ['search' => 'zx']);

        $this->assertCount(1,$response['posts']);
    }

    /** Single Post found
     * @test
     */
    public function check_single_post_found_endpoint(){
        $response = $this->get('/api/single/1');

        $this->assertNotNull( $response['post']);
    }

    /** Single Post not found
     * @test
     */
    public function check_single_post_not_found_endpoint(){
        $response = $this->get('/api/single/111');

        $this->assertNull( $response['post']);
    }

    /**
     * Store Post
     * @test
     */
    public function check_store_post_endpoint(){
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
        $requestArr = ['title' => 'Test', 'description' => 'Description' ,'category_id' => [1,3,'other'], 'category' => 'Test Category'];
        $response = $this->post('/api/post',$requestArr);

        $response->assertStatus(200)->assertJson(['success' => 'Post Created']);
    }
}
