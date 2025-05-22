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
            window.hugerte && hugerte.init({
                target: $refs.editor,
                height: {{ $options['height'] }},
                menubar: {!! json_encode($options['menubar']) !!},
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
            class="filament-forms-field-input"
        ></textarea>
    </div>
</x-dynamic-component>