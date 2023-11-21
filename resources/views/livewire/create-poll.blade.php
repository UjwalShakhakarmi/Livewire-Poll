<div>
    <form wire:submit.prevent="createPoll">
        <label for="">Poll Title</label>
        <input type="text" wire:model.live="title"/>
        @error('title')
            <div class="text-red-500">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-4 mt-2">
            <button class="btn" wire:click.prevent="addOption">Add Option</button>
        </div>

        <div>
        @foreach ($options as $index => $option)
        <div class="mb-4">
            <label for="">Option {{ $index + 1 }}</label>
            <div class="flex gap-2">
            <!-- options is an array in CreatePoll and dynamically bind 
            each input field to the corresponding index in the $options array.-->
            <input type="text" wire:model="options.{{ $index }}" />
            <button class="btn" wire:click.prevent= "removeOption({{ $index }})">Remove</button>
        </div>
            @error("options.{$index}")
                <div class="text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @endforeach
        </div>
        <button class="btn" type="submit">Create Poll</button>
    </form>
</div>
