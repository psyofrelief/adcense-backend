<?php

namespace App\Http\Controllers;

use App\Models\AdDomain;
use App\Services\EasyListParser;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class AdDomainController extends Controller
{
    protected $easyListParser;

    public function __construct(EasyListParser $easyListParser)
    {
        $this->easyListParser = $easyListParser;
    }

    public function index()
    {
        $adDomains = AdDomain::first(); // Assuming there's only one record with the domains
        return response()->json([
            "domains" => json_decode($adDomains->domains),
        ]);
    }

    public function store()
    {
        $rules = $this->easyListParser->parse();

        // Store the rules as a JSON object
        AdDomain::truncate(); // Clear old entries
        AdDomain::create(["domains" => json_encode($rules)]);

        return response()->json([
            "message" => "Ad domains updated successfully.",
        ]);
    }

    public function destroy()
    {
        AdDomain::first()->delete();

        return response()->json(null, 204);
    }
}
