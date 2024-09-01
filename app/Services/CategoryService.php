<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function make($validated)
    {
        $firstObject = $validated[0];
        array_shift($validated);

        $parent = Category::create([
            'title' => $firstObject['title'],
            'parent_id' => null
        ]);
        foreach ($validated as $data){
            Category::create([
                'title' => $data['title'],
                'parent_id' => $parent['id']
            ]);
        }
    }
}
