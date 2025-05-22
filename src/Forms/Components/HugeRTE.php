<?php

namespace BuzzyMind\FilamentHugeRTE\Forms\Components;

use Filament\Forms\Components\Field;

class HugeRTE extends Field
{
    protected string $view = 'filament-hugerte::components.hugerte';

    protected array $hugeRteOptions = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->default('');
        $this->afterStateHydrated(function ($component, $state) {
            if ($state === null) {
                $component->state('');
            }
        });
    }

    public function options(array $options): static
    {
        $this->hugeRteOptions = $options;
        return $this;
    }

    public function getViewData(): array
    {
        $defaultOptions = [
            'height' => 500,
            'menubar' => 'file edit view insert format tools table help',
            'plugins' => [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount',
                'emoticons', 'codesample', 'directionality', 'quickbars', 'hr', 'pagebreak',
                'nonbreaking', 'save', 'template', 'print', 'paste', 'autosave', 'importcss',
            ],
            'toolbar' => 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | codesample emoticons hr pagebreak | removeformat | fullscreen preview print | help',
        ];

        $options = array_merge($defaultOptions, $this->hugeRteOptions);
        $this->extraAttributes(['options' => $options]);

        return parent::getViewData();
    }
}