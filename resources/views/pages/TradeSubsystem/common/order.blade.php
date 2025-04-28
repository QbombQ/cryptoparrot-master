<tr>
    <td scope="row">{{ $order['id'] }}</td>
    <td scope="row">
        @if($order['status'] == 'open')
            <a class="btn btn-secondary btn-sm btn-block close-trade" href="/app/trade/{{$order['id']}}/close">Close</a>
        @elseif($order['status'] == 'active')
            <a class="btn btn-primary btn-sm btn-block cancel-trade" href="/app/trade/{{$order['id']}}/cancel">Cancel</a>
        @endif
    </td>
    <td scope="row">{{ $order['type'] }}</td>
    <td scope="row">{{ $order['pair'] }}</td>
    <td scope="row">{{ $order['targetPrice'] }}</td>
    <td scope="row">{{ $order['amount'] }}</td>
    <td scope="row">{{ $order['cost'] }}</td>
    <td scope="row">{{ $order['status'] }}</td>
    <td scope="row">{{ $order['leverage'] }}</td>
    <td scope="row">
    @if($order['leverage'] && is_numeric($order['leverage']))
    {{ ($order['leverage'] * 0.25) }}% 
    @else
    n/a <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fee is only applied to leverage trades. Fee = 0.25% x leverage"><i class="ml-2 far fa-question-circle"></i></a>
    @endif
    </td> 
    <td scope="row">{{ $order['opened'] }}</td>
    <td scope="row">{{ $order['profit'] }} <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Profit only available once position is closed. To check current profit/loss please go to homepage and find open positions widget."><i class="ml-2 far fa-question-circle"></i></td>
    <td scope="row">{{ $order['stopLoss'] }}</td>
    <td scope="row">{{ $order['takeProfit'] }}</td>
</tr> 