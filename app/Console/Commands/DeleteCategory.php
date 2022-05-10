<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete category';

    /**
     * Category Service.
     *
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Create a new command instance.
     *
     * @param CategoryService $categoryService
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

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
        $choices = [];
        foreach ($categories as $category) {
            $choices[$category->id] = $category->name;
        }

        $nameCategory = $this->choice('Choose category?', $choices);
        $id = array_search($nameCategory, $choices);

        $this->categoryService->destroy($id);

        $this->info('Category deleted successfully');
    }
}
