@extends('layout')

@section('main')
<div id="p-orders-create">
    <form action="{{ route('orders.store') }}" method="POST">
    @csrf
        <div class="row">
            <div class="col-2"></div>
            <div class="col-5">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Full name</label>
                        <input type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" maxlength="64" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}" maxlength="255" required>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label class="form-label"">Zipcode</label>
                                <input type="text" class="form-control" name="zipcode" value="{{ old('zipcode') }}" maxlength="16" required>
                            </div>
                            <div class="col">
                                <label class="form-label"">City</label>
                                <input type="text" class="form-control" name="city" value="{{ old('city') }}" maxlength="64" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"">Country</label>
                        <input type="text" class="form-control" name="country" value="{{ old('country') }}" maxlength="64" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"">Card number</label>
                        <input pattern="[0-9]{16}" type="text" class="form-control" placeholder="1234123412341234" name="card_number" value="{{ old('card_number') }}" minlength="16" maxlength="16" required>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label class="form-label"">Card CVV</label>
                                <input pattern="[0-9]{3}" type="text" class="form-control" placeholder="123" name="card_cvv" value="{{ old('card_cvv') }}" minlength="3" maxlength="3" required>
                            </div>
                            <div class="col">
                                <label class="form-label"">Card Expiration</label>
                                <input pattern="[0-9]{2}/[0-9]{2}" type="text" class="form-control" placeholder="09/25" name="card_expiration" value="{{ old('card_expiration') }}" minlength="5" maxlength="5" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-warning">Confirm the order</button>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-3 text-center">
                <div class="row mb-3">
                    <div class="col">
                        <h3>Total: {{ number_format($t_cart['compute']['total'],2) }}$</h3>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <button type="submit" class="btn btn-warning">Confirm the order</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col lorem">
                        Sed et est nec lectus sodales convallis non vulputate metus. Proin varius justo ut scelerisque viverra. Sed odio nisi, convallis nec sagittis ac, ornare vitae magna. Sed mauris lectus, viverra a interdum eu, tempus sed metus. Praesent quis efficitur felis, id porta risus. Vivamus ipsum risus, dignissim id vestibulum in, mattis eget tortor. Nulla facilisi.
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row mt-5">
        <div class="col blabla">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
    </div>
</div>
@endsection
