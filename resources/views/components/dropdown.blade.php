@props(['trigger'])
<div x-data="{ show: false}" @click.away="{show = false}">
  <div @click="show = ! show">
    {{ $trigger }}
  </div>
  <div x-show="show" class="py-2 bg-gray-100 absolute mt-2 w-full rounded-xl z-50 overflow-auto max-h-52" style="display: none">
    {{ $slot }}
  </div>

</div>
