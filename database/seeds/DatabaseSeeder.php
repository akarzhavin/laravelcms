<?php



use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('CategoriesTableSeeder');
        $this->call('CategoryDescriptionSeeder');
        $this->call('ImagesSeeder');
        $this->call('RolesSeeder');
        $this->call('UsersTableSeeder');
        $this->call('ProductsTableSeeder');
        $this->call('ProductDescriptionsSeeder');
        $this->call('ProductRolePricesSeeder');
        $this->call('ProductImagesSeeder');
        $this->call('FeatureSeeder');
        $this->call('FeatureDescriptionSeeder');
        $this->call('FeatureValuesSeeder');
        $this->call('ProductFeaturePivotSeeder');
        $this->call('FilterSeeder');
        $this->call('GallerySeeder');
    }
}
