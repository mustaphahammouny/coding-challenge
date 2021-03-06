<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Validation\ValidationException;

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
     * Category Service.
     *
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Product Service.
     *
     * @var ProductService
     */
    protected $productService;

    /**
     * Create a new command instance.
     *
     * @param CategoryService $categoryService
     * @param ProductService $productService
     * @return void
     */
    public function __construct(
        CategoryService $categoryService,
        ProductService $productService
    )
    {
        $this->categoryService = $categoryService;

        $this->productService = $productService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $categories = $this->categoryService->index();
        $choices = ['None'];
        foreach ($categories as $category) {
            $choices[$category->id] = $category->name;
        }

        $data['name'] = $this->ask('Enter name?');
        $data['description'] = $this->ask('Enter description?');
        $data['price'] = $this->ask('Enter price?');
        $data['image'] = $this->ask('Enter image path?');
        $names = $this->choice('Choose one or multiple categories?', $choices, 0, null, true);

        try {
            $data['image'] = $data['image'] ? new File($data['image'], true) : '';
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        if (!in_array('None', $names)) {
            $data['categories'] = [];
            foreach ($names as $name) {
                array_push($data['categories'], array_search($name, $choices));
            }
        }

        try {
            $this->productService->store($data);
        } catch (ValidationException $exception) {
            $this->error($exception->getMessage());
            foreach ($exception->errors() as $error) {
                $this->error($error[0]);
            }
            return;
        }

        $this->info('Product created successfully');
    }
}
