@props([
    'name',
    'action',
    'message' => null,
])

<div>
    <flux:modal.trigger name="confirm-delete">
        <flux:button variant="danger">
            Delete
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-delete" class="max-w-lg">

        <div class="space-y-6">

            <div>
                <flux:heading size="lg">
                    Confirm deletion
                </flux:heading>

                <flux:subheading>
                    {{ $message ?? "Are you sure you want to delete {$name}? This action cannot be undone." }}
                </flux:subheading>
            </div>

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="filled">
                        Cancel
                    </flux:button>
                </flux:modal.close>

                <form
                    method="POST"
                    action="{{ $action }}"
                >
                    @csrf
                    @method('DELETE')

                    <flux:button
                        type="submit"
                        variant="danger"
                    >
                        Delete
                    </flux:button>
                </form>

            </div>

        </div>

    </flux:modal>
</div>
