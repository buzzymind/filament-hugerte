@php
    $id = $getId();
    $statePath = $getStatePath();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{ state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $statePath . '\')') }} }"
        x-init="
            HugeRTE.init({
                target: $refs.editor,
                height: {{ $options['height'] }},
                menubar: {{ $options['menubar'] ? 'true' : 'false' }},
                plugins: {{ json_encode($options['plugins']) }},
                toolbar: '{{ $options['toolbar'] }}',
                setup: (editor) => {
                    editor.on('change', () => {
                        state = editor.getContent();
                    });
                }
            });
        "
    >
        <textarea
            x-ref="editor"
            id="{{ $id }}"
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $statePath }}"
            {{ $isAutofocused() ? 'autofocus' : null }}
            {{ $isDisabled() ? 'disabled' : null }}
            {{ $isRequired() ? 'required' : null }}
            {{ $applyStateBindingModifiers('wire:loading') }}.attr('disabled')
            {{ $getExtraAlpineAttributeBag()->class(['filament-forms-field-input']) }}
        ></textarea>
    </div>
</x-dynamic-component> 