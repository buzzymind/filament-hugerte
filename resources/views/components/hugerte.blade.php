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
            $nextTick(() => {
                if (window.hugerte) {
                    hugerte.init({
                        target: $refs.editor,
                        height: {{ $options['height'] }},
                        menubar: {!! is_bool($options['menubar']) ? ($options['menubar'] ? 'true' : 'false') : (is_string($options['menubar']) ? ('\'' . $options['menubar'] . '\'') : json_encode($options['menubar'])) !!},
                        plugins: {{ json_encode($options['plugins']) }},
                        toolbar: '{{ $options['toolbar'] }}',
                        setup: (editor) => {
                            editor.on('change', () => {
                                state = editor.getContent();
                            });
                            editor.on('init', () => {
                                editor.setContent(state ?? '');
                            });
                        }
                    });
                }
            });
        "
    >
        <textarea
            x-ref="editor"
            id="{{ $id }}"
            x-model="state"
            class="filament-forms-field-input"
        ></textarea>
    </div>
</x-dynamic-component>