<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete product';

    /**
     * Product Service.
     *
     * @var ProductService
     */
    protected $productService;

    /**
     * Create a new command instance.
     *
     * @param ProductService $productService
     * @return void
     */
    public function __construct(ProductService $productService)
    {
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
        $products = $this->productService->index();
        $choices = [];
        foreach ($products as $product) {
            $choices[$product->id] = $product->name;
        }

        $nameProduct = $this->choice('Choose product?', $choices);
        $id = array_search($nameProduct, $choices);

        $this->productService->destroy($id);

        $this->info('Product deleted successfully');
    }
}
