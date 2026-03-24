<?php

namespace App\Patterns\PropertyContainer;

class BlogPost extends PropertyContainer
{
    private string $title;

    private int $category_id;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->category_id = $categoryId;
    }
}
