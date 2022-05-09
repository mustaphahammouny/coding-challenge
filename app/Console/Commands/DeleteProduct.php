<?php

namespace App\Console\Commands;

use App\Repositories\ProductRepository;
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
     * Product Repository.
     *
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * Create a new command instance.
     *
     * @param ProductRepository $productRepository
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
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
        $products = $this->productRepository->all();
        $choices = [];
        foreach ($products as $product) {
            $choices[$product->id] = $product->name;
        }

        $nameProduct = $this->choice('Choose product?', $choices);
        $id = array_search($nameProduct, $choices);

        $this->productRepository->delete($id);

        $this->info('Product deleted successfully');
    }
}
