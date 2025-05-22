@php
    $id = $getId();
    $statePath = $getStatePath();
    if (isset($options['height'])) {
        $height = (int) $options['height'];
    } else {
        $height = 500;
    }
    if (array_key_exists('menubar', $options)) {
        $menubar = $options['menubar'];
    } else {
        $menubar = true;
    }
    if (isset($options['plugins'])) {
        $plugins = json_encode($options['plugins']);
    } else {
        $plugins = '[]';
    }
    if (isset($options['toolbar'])) {
        $toolbar = str_replace("'", "\\'", $options['toolbar']);
    } else {
        $toolbar = '';
    }
    if (is_bool($menubar)) {
        if ($menubar) {
            $menubarJs = 'true';
        } else {
            $menubarJs = 'false';
        }
    } else if (is_string($menubar)) {
        $menubarJs = "'" . str_replace("'", "\\'", $menubar) . "'";
    } else if (is_array($menubar)) {
        $menubarJs = json_encode($menubar);
    } else {
        $menubarJs = 'true';
    }
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        wire:ignore
        x-data="{
            instance: null,
            state: @entangle($statePath) ?? ''
        }"
        x-init="
            $nextTick(() => {
                if (window.hugerte && !instance) {
                    instance = hugerte.init({
                        target: $refs.editor,
                        height: {{ $height }},
                        menubar: {!! $menubarJs !!},
                        plugins: {!! $plugins !!},
                        toolbar: '{{ $toolbar }}',
                        setup: (editor) => {
                            editor.on('change', () => {
                                $wire.set('{{ $statePath }}', editor.getContent());
                            });
                            editor.on('init', () => {
                                editor.setContent(state);
                            });
                        }
                    });
                }
            });
        "
        x-effect="
            if (instance && state !== instance.getContent()) {
                instance.setContent(state);
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