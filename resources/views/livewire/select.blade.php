<div class="select-wrapper" x-data="{
    search: $wire.searchUser,
    data: $wire.users,
    show: false,
    selected: [],
    filteredData: [],
    filterData() {
        this.filteredData = this.data.filter(el => el.label.toLowerCase().includes(this.search.toLowerCase()))
    }
}" x-on:click.outside="show=false" x-init="filteredData = data;
console.log(data)">
    <x-text-input x-model="search" x-on:focus="show=true" class="w-full max-w-xs" />
    <div x-show="show" x-collapse
        class="border-2 border-indigo-500 mt-1 rounded-lg p-2 shadow flex gap-2 flex-col max-h-64 overflow-y-auto">
        <p>Klik Untuk Pilih</p>
        <template x-for="item in filteredData">
            <button type="button" class="p-2 rounded-lg border active:bg-indigo-500/10 text-start"
                x-on:click="selected.includes(item) ? selected.splice(selected.indexOf(item), 1) : selected.push(item)"
                :class="{ 'bg-indigo-500/10': selected.includes(item) }">
                <p x-text="item.name"></p>
            </button>
        </template>
        {{-- <template x-if="filteredData.length <1">
                                        <p>Data Tidak Ditemukan.</p>
                                    </template> --}}
    </div>
</div>
