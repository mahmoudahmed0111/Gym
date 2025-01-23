<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $package1 = Package::create([
            'name' => 'Basic Plan',
            'desc' => 'Basic features for starters',
            'type' => 'club',
            'time' => 6,
            'price' => 100,
        ]);

        $package2 = Package::create([
            'name' => 'Pro Plan',
            'desc' => 'Advanced features for professionals',
            'type' => 'club',
            'time' => 12,
            'price' => 200,
        ]);

        $package3 = Package::create([
            'name' => 'Enterprise Plan',
            'desc' => 'Full features for enterprises',
            'type' => 'club',
            'time' => -1,
            'price' => 300,
        ]);

        // Add features for each package
        PackageFeature::create(['package_id' => $package1->id, 'name' => 'Feature 1']);
        PackageFeature::create(['package_id' => $package1->id, 'name' => 'Feature 2']);
        PackageFeature::create(['package_id' => $package1->id, 'name' => 'Feature 3']);

        PackageFeature::create(['package_id' => $package2->id, 'name' => 'Feature 1']);
        PackageFeature::create(['package_id' => $package2->id, 'name' => 'Feature 2']);
        PackageFeature::create(['package_id' => $package2->id, 'name' => 'Feature 3']);
        PackageFeature::create(['package_id' => $package2->id, 'name' => 'Feature 4']);
        PackageFeature::create(['package_id' => $package2->id, 'name' => 'Feature 5']);

        PackageFeature::create(['package_id' => $package3->id, 'name' => 'Feature 1']);
        PackageFeature::create(['package_id' => $package3->id, 'name' => 'Feature 2']);
        PackageFeature::create(['package_id' => $package3->id, 'name' => 'Feature 3']);
        PackageFeature::create(['package_id' => $package3->id, 'name' => 'Feature 4']);
        PackageFeature::create(['package_id' => $package3->id, 'name' => 'Feature 5']);
        PackageFeature::create(['package_id' => $package3->id, 'name' => 'Feature 6']);
        PackageFeature::create(['package_id' => $package3->id, 'name' => 'Feature 7']);


    }
}
