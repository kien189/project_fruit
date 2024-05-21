<h3>Xin chào : {{ $order->customers->name }}</h3>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore facilis dolore totam voluptas vitae labore nostrum
    velit excepturi ipsam architecto! Numquam, iusto blanditiis. Similique, consectetur! Tenetur rem excepturi iure
    aliquam!</p>
<h4>Your oder detail</h4>

<table border="1" cellpadding="5" clellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Product name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub total</th>
            <th>Sub total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->details as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity) }}</td>
                <td>{{ number_format($item->totalPrice) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<p>
    <a href="{{ route('order.verify', $token) }}">CLick here to verify your shopping</a>
</p>
