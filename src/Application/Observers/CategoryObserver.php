<?php

namespace Application\Observers;

use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\Category;

class CategoryObserver
{
    public function creating(Category $category)
    {
        $category->url = Str::kebab($category->name);
    }

    public function updating(category $category)
    {
        $category->url = Str::kebab($category->name);
    }
}
