<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
use Illuminate\Console\Command;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create category';

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
        $nameCategory = $this->choice('Choose parent category?', $choices, 0);
        if ($nameCategory != 'None') {
            $data['parent_category'] = array_search($nameCategory, $choices);
        }

        $this->categoryRepository->create($data);

        $this->info('Category created successfully');
    }
}
