<div class="list-group">
    <a href="{{ route('users.dashboard') }}" class="list-group-item list-group-item-action @if($active=='dashboard') active @endif">Dashboard</a>
    <a href="{{ route('users.edit') }}" class="list-group-item list-group-item-action  @if($active=='profile') active @endif">Profile</a>
    <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action @if($active=='orders') active @endif">Orders</a>
    <a href="{{ route('password.change') }}" class="list-group-item list-group-item-action @if($active=='change-password') active @endif">Change password</a>
</div>
