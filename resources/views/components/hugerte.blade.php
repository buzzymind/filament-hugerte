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
                        $wire.set('{{ $statePath }}', editor.getContent());
                    });
                    editor.on('init', () => {
                        editor.setContent(state ?? '');
                    });
                }
            });
        "
    >
        <textarea
            x-ref="editor"
            id="{{ $id }}"
            style="display:none;"
            class="filament-forms-field-input"
        ></textarea>
    </div>
</x-dynamic-component>