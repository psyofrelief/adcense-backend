<?php

use App\Models\AdDomain;

use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it("can fetch the list of ad domains", function () {
    AdDomain::factory()->create(["domains" => json_encode(["example.com"])]);

    $response = get("/ad-domains")
        ->assertStatus(200)
        ->assertJsonStructure(["domains"]);

    $domains = $response->json()["domains"];

    // Assert that the length of the domains array is at least 5
    expect(count($domains))->toBeGreaterThanOrEqual(5);
});

// it('can add a new ad domain', function () {
//     $adDomain = AdDomain::factory()->create(['domains' => json_encode([])]);

//     post('/api/ad-domains', ['domain' => 'newdomain.com'])
//         ->assertStatus(201);

//     $adDomain->refresh();
//     $domains = json_decode($adDomain->domains, true);

//     expect($domains)->toContain('newdomain.com');
// });

// it('can delete an ad domain', function () {
//     $adDomain = AdDomain::factory()->create(['domains' => json_encode(['tobedeleted.com'])]);

//     delete("/api/ad-domains/{$adDomain->id}", ['domain' => 'tobedeleted.com'])
//         ->assertStatus(204);

//     $adDomain->refresh();
//     $domains = json_decode($adDomain->domains, true);

//     expect($domains)->not->toContain('tobedeleted.com');
// });
