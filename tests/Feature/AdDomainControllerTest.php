<?php

it("can add a new ad domain", function () {
    $this->post("/ad-domains")->assertStatus(200);
});

it("can fetch the list of ad domains", function () {
    $response = $this->get("/ad-domains")
        ->assertStatus(200)
        ->assertJsonStructure(["domains"]);

    $domains = $response->json()["domains"];

    expect(count($domains))->toBeGreaterThanOrEqual(5);
});

it("can delete an ad domain", function () {
    $this->delete("/ad-domains")->assertStatus(204);
});
