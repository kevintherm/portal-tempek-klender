<form action="{{ route($route, $parameter) }}" method="POST" class="p-6 text-gray-900 dark:text-gray-100"
    x-data="{
        postType: '{{ old('type', $post ? $post->type->value : '') }}',
        editor: null,
        slug: '',
    }" x-ref="form">
    @csrf
    @method($method)

    <h3 class="text-xl font-semibold mb-8">{{ $subtitle }}</h3>


    <div class="pb-4">
        <x-input-label value="Tipe Postingan" />
        <select
            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            name="type" x-model="postType">
            <option {{ old('type', $post ? $post->type->value : '') === 'post' ? 'selected' : '' }} value="post">
                Postingan
            </option>
            <option {{ old('type', $post ? $post->type->value : '') === 'kegiatan' ? 'selected' : '' }}
                value="kegiatan">
                Kegiatan
            </option>
            <option {{ old('type', $post ? $post->type->value : '') === 'pengumuman' ? 'selected' : '' }}
                value="pengumuman">
                Pengumuman</option>
        </select>
        @error('type')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div class="pb-4">
        <x-input-label value="Judul" />
        <x-text-input name="title" class="max-w-md w-full" :value="old('title', $post ? $post->title : '')" wire:model="title"
            wire:change="get_slug" />
        @error('title')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div class="pb-4">
        <x-input-label value="Slug" />
        <x-text-input name="slug" class="max-w-md w-full" :value="old('slug', $post ? $post->slug : '')" wire:model="slug" />
        @error('slug')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div class="pb-4" wire:ignore>
        <x-input-label value="Isi" />
        <textarea x-init="editor = suneditor.create($el, {
            height: 'auto',
            plugins: plugins,
            buttonList: [
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['paragraphStyle', 'blockquote'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['fontColor', 'hiliteColor', 'textStyle'],
                ['removeFormat'],
                '/', // Line break
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'lineHeight'],
                ['table', 'link', 'image', 'video', 'audio'],
                ['fullScreen', 'showBlocks', 'codeView'],
                ['preview', 'print'],
                ['save']
            ]
        });" name="body" class="max-w-full w-full">{!! old('body', $post ? $post->body : '') !!}</textarea>
        @error('body')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div x-show="postType == 'kegiatan'" x-collapse>
        <x-input-label value="Kehadiran" />
        <x-text-input :textarea="true" name="attendance_list" class="max-w-md w-full" :value="old('attendance_list', $post ? $post->attendance_list : '')" />
        @error('attendance_list')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div x-show="postType == 'kegiatan' || postType == 'pengumuman'" x-collapse
        class="flex flex-row items-center gap-2">
        <x-text-input type="checkbox" name="show_on_featured" :checked="old('show_on_featured', $post ? $post->show_on_featured : true)" :value="1" />
        <x-input-label value="Pajang di Halaman Depan" />
        @error('show_on_featured')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div class="pt-4">
        <x-secondary-button onclick="history.back()">
            Batal
        </x-secondary-button>
        <x-primary-button @click.prevent="editor.save(); $refs.form.submit()">
            Simpan
        </x-primary-button>
    </div>

</form>
