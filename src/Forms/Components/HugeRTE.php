<?php

namespace BuzzyMind\FilamentHugeRTE\Forms\Components;

use Filament\Forms\Components\Field;

class HugeRTE extends Field
{
    protected string $view = 'filament-hugerte::components.hugerte';

    protected function setUp(): void
    {
        parent::setUp();

        $this->default([]);
    }

    public function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'options' => [
                'height' => 500,
                'menubar' => true,
                'plugins' => [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                'toolbar' => 'undo redo | blocks | ' .
                    'bold italic backcolor | alignleft aligncenter ' .
                    'alignright alignjustify | bullist numlist outdent indent | ' .
                    'removeformat | help',
            ],
        ]);
    }
} 