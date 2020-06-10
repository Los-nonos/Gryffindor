<?php


namespace Domain\Entities;


use Doctrine\Common\Collections\ArrayCollection;

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

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

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
    public function getOptions()
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
