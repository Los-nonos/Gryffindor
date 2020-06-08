<?php


namespace Domain\Entities;


class Filter
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var string
     */
    private $name;

    /**
     * @var FilterOption[]
     */
    private $options;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return FilterOption[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param FilterOption $options
     */
    public function addOption(FilterOption $options): void
    {
        $this->options[] = $options;
    }

    public function removeOption(FilterOption $option): void
    {
        // TODO: implement
    }
}
