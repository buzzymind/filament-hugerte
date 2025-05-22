@php
    $id = $getId();
    $statePath = $getStatePath();
    $height = isset($options['height']) ? (int) $options['height'] : 500;
    $menubar = array_key_exists('menubar', $options) ? $options['menubar'] : true;
    $plugins = isset($options['plugins']) ? json_encode($options['plugins']) : '[]';
    $toolbar = isset($options['toolbar']) ? str_replace("'", "\\'", $options['toolbar']) : '';
    // PHP < 8.0 compatibility: não use operador "?" em contexto de array
    if (is_bool($menubar)) {
        $menubarJs = $menubar ? 'true' : 'false';
    } elseif (is_string($menubar)) {
        $menubarJs = "'" . str_replace("'", "\\'", $menubar) . "'";
    } elseif (is_array($menubar)) {
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
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $statePath . '\') ) }}
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
                                editor.setContent(state ? state : '');
                            });
                        }
                    });
                }
            });
        "
        x-effect="
            if (instance && state !== instance.getContent()) {
                instance.setContent(state ? state : '');
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