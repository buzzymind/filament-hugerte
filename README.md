# Filament HugeRTE

Um plugin do Filament que integra o editor de texto rico HugeRTE aos seus formulários.

## Instalação

```bash
composer require buzzymind/filament-hugerte
```

## Uso

Para usar o editor HugeRTE em seus formulários do Filament, simplesmente adicione o componente `HugeRTE` ao seu formulário:

```php
use BuzzyMind\FilamentHugeRTE\Forms\Components\HugeRTE;

// Em seu formulário
public function form(Form $form): Form
{
    return $form
        ->schema([
            HugeRTE::make('content')
                ->label('Conteúdo')
                ->required(),
        ]);
}
```

## Configuração

O componente HugeRTE vem com configurações padrão que podem ser personalizadas:

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

## Licença

MIT 