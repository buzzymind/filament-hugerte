# Filament HugeRTE

A Filament plugin that integrates the HugeRTE rich text editor into your forms.

## Installation

```bash
composer require buzzymind/filament-hugerte
```

## Usage

To use the HugeRTE editor in your Filament forms, simply add the `HugeRTE` component to your form:

```php
use BuzzyMind\FilamentHugeRTE\Forms\Components\HugeRTE;

// In your form
public function form(Form $form): Form
{
    return $form
        ->schema([
            HugeRTE::make('content')
                ->label('Content')
                ->required(),
        ]);
}
```

## Configuration

The HugeRTE component comes with default settings that can be customized:

```php
HugeRTE::make('content')
    ->options([
        'height' => 500,
        'menubar' => true,
        'plugins' => [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        'toolbar' => 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    ])
```

## License

MIT