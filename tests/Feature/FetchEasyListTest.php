<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\artisan;

beforeEach(function () {
    // Use fake storage for isolation
    Storage::fake();
});

afterEach(function () {
    // Clean up the storage after each test
    Storage::disk("local")->delete("easylist.txt");
});

it("fetches and stores EasyList successfully", function () {
    // Mock the HTTP response
    Http::fake([
        "https://easylist.to/easylist/easylist.txt" => Http::response(
            "mocked content",
            200
        ),
    ]);

    // Run the command
    artisan("app:fetch-easy-list-domains")
        ->expectsOutput("EasyList downloaded successfully.")
        ->assertExitCode(0);

    // Assert that the file was stored
    Storage::assertExists("easylist.txt");

    // Assert that the content is as expected
    expect(Storage::get("easylist.txt"))->toBe("mocked content");
});

it("handles failed fetch", function () {
    // Mock the HTTP response to return a failure
    Http::fake([
        "https://easylist.to/easylist/easylist.txt" => Http::response(
            null,
            500
        ),
    ]);

    // Run the command
    artisan("app:fetch-easy-list-domains")
        ->expectsOutput("Failed to download EasyList.")
        ->assertExitCode(0);
});

it("uses the correct URL", function () {
    // Spy the HTTP facade to capture the requested URL and return a valid response
    Http::fake([
        "https://easylist.to/easylist/easylist.txt" => Http::response(
            "mocked content",
            200
        ),
    ]);

    // Run the command
    artisan("app:fetch-easy-list-domains")->assertExitCode(0);

    // Assert that the correct URL was requested
    Http::assertSent(function ($request) {
        return $request->url() === "https://easylist.to/easylist/easylist.txt";
    });
});
