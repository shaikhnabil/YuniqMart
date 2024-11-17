<div>
    <h3 class="mt-4 text-center"><i class="bi bi-bell"> Notifications</i></h3>
    <div class="container">
        <h5 class="text-muted">New Notifications</h5>
        @if (auth()->user()->unreadNotifications->count() > 0)
            <p class="text-center text-decoration-none">
                <a href="{{ route('mark-as-read') }}" class="border btn btn-dark btn-sm">
                    <i class="bi bi-check2-all"> Mark all as read</i>
                </a>
            </p>
        @else
            <p class="text-center text-muted">New Notification Not Available</p>
        @endif

        @foreach (auth()->user()->unreadNotifications as $notification)
            <a href="{{ route('products.show', $notification->data['product_id']) }}" class="text-decoration-none">
                <li class="p-3 m-2 border shadow border-warning badge text-bg-light w-75">
                     <span class="badge text-bg-dark">Click me!</span>
                        {{ $notification->data['message'] }} <i class="bi bi-check float-end"></i>
                </li>
            </a>

            <button type="button"
                           wire:click='markAsReadone("{{ $notification->id }}")' class="border-0 bg-light"
                             aria-label="Close"><i class="bi bi-x-circle-fill text-danger"></i></button>
        @endforeach



        <h5 class="mt-3 text-muted">Old Notifications</h5>
        @foreach (auth()->user()->readNotifications as $notification)
            <a href="{{ route('products.show', $notification->data['product_id']) }}" class="text-decoration-none">
                <li class="p-3 m-2 border shadow border-success badge text-bg-light w-75">
                     <span class="badge text-bg-dark">Click me!</span>
                        {{ $notification->data['message'] }} <i class="bi bi-check-all float-end"></i>
                </li>
            </a>
        @endforeach
        </p>
    </div>
