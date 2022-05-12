<?php

namespace App\Console\Commands;

use App\Constants\Rules;
use App\Services\CategoryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

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
        $choices = ['None'];
        foreach ($categories as $category) {
            $choices[$category->id] = $category->name;
        }

        $data['name'] = $this->ask('Enter name?');
        $nameCategory = $this->choice('Choose parent category?', $choices, 0);
        if ($nameCategory != 'None') {
            $data['parent_category'] = array_search($nameCategory, $choices);
        }

        $validator = Validator::make($data,Rules::STORE_CATEGORY_RULES);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        $this->categoryService->store($data);

        $this->info('Category created successfully');
    }
}
