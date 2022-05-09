<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create product';

    /**
     * Category Repository.
     *
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Product Repository.
     *
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * Create a new command instance.
     *
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository
    )
    {
        $this->categoryRepository = $categoryRepository;

        $this->productRepository = $productRepository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $categories = $this->categoryRepository->all();
        $choices = ['None'];
        foreach ($categories as $category) {
            $choices[$category->id] = $category->name;
        }

        $data['name'] = $this->ask('Enter name?');
        $data['description'] = $this->ask('Enter description?');
        $data['price'] = $this->ask('Enter price?');
        $path = $this->ask('Enter image path?');
        $names = $this->choice('Choose one or multiple categories?', $choices, 0, null, true);

        try {
            $file = new File($path, true);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }
        $data['image'] = Storage::disk('public')->putFile('products', $file);

        $product = $this->productRepository->create($data);

        if (!in_array('None', $names)) {
            $ids = [];
            foreach ($names as $name) {
                array_push($ids, array_search($name, $choices));
            }
            $this->productRepository->attach($product->categories(), $ids);
        }

        $this->info('Product created successfully');
    }
}
