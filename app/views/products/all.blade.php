<ul>
    @foreach($products as $product)

    <li>{{ $product->title }}: <strong>{{ $product->getPrice()->format() }}</strong></li>

    @endforeach
</ul>


<div>
    Change currency:
    <a href="/change-currency/QAR">QAR</a>
    <a href="/change-currency/EGP">EGP</a>
    <a href="/change-currency/USD">USD</a>
</div>