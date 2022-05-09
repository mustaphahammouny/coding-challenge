<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
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
     * Category Repository.
     *
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Create a new command instance.
     *
     * @param CategoryRepository $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categories = $this->categoryRepository->all();
        $choices = [];
        foreach ($categories as $category) {
            $choices[$category->id] = $category->name;
        }

        $nameCategory = $this->choice('Choose category?', $choices);
        $id = array_search($nameCategory, $choices);

        $this->categoryRepository->delete($id);

        $this->info('Category deleted successfully');
    }
}
