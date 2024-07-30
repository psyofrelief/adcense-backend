<?php
use App\Services\EasyListParser;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    // Mock the storage before each test
    Storage::fake("local");
});

afterEach(function () {
    // Clean up the storage after each test
    Storage::disk("local")->delete("easylist.txt");
});

it("parses easylist file correctly", function () {
    // Mock the storage with a sample EasyList content
    Storage::disk("local")->put(
        "easylist.txt",
        "
        ! This is a comment line
        ||example.com^
        ||example.org^
        [Adblock Plus 2.0]
        ||example.net^
        ! Another comment
        ||example.edu^
    "
    );

    // Instantiate the parser
    $parser = new EasyListParser();

    // Parse the rules
    $rules = $parser->parse();

    // Expected rules without comments or metadata
    $expectedRules = [
        "||example.com^",
        "||example.org^",
        "||example.net^",
        "||example.edu^",
    ];

    // Assert the parsed rules are as expected
    expect($rules)->toBe($expectedRules);
});
