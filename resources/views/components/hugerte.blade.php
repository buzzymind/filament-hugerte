@php
    $id = $getId();
    $statePath = $getStatePath();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        wire:ignore
        x-data="{
            instance: null,
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $statePath . '\') ) }}
        }"
        x-init="
            $nextTick(() => {
                if (window.hugerte && !instance) {
                    instance = hugerte.init({
                        target: $refs.editor,
                        height: {{ (int) $options['height'] }},
                        menubar: {!! is_bool($options['menubar']) ? ($options['menubar'] ? 'true' : 'false') : (is_string($options['menubar']) ? ('\'' . addslashes($options['menubar']) . '\'') : json_encode($options['menubar'])) !!},
                        plugins: {{ json_encode($options['plugins']) }},
                        toolbar: '{{ addslashes($options['toolbar']) }}',
                        setup: (editor) => {
                            editor.on('change', () => {
                                $wire.set('{{ $statePath }}', editor.getContent());
                            });
                            editor.on('init', () => {
                                editor.setContent(state ?? '');
                            });
                        }
                    });
                }
            });
        "
        x-effect="
            if (instance && state !== instance.getContent()) {
                instance.setContent(state ?? '');
            }
        "
    >
        <textarea
            x-ref="editor"
            id="{{ $id }}"
            class="filament-forms-field-input"
        ></textarea>
    </div>
</x-dynamic-component>