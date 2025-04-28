<tr>
    <td scope="row">{{ $order['id'] }}</td>
    <td scope="row"><a class="btn btn-secondary btn-sm btn-block" href="/{{$order['slug']}}/trade/{{$order['id']}}">View</a></td>
    <td scope="row">{{ $order['type'] }}</td>
    <td scope="row">{{ $order['pair'] }}</td>
    <td scope="row">{{ $order['targetPrice'] }}</td>
    <td scope="row">{{ $order['amount'] }}</td>
    <td scope="row">{{ $order['cost'] }}</td>
    <td scope="row">{{ $order['status'] }}</td>
    <td scope="row">{{ $order['leverage'] }}</td>
    <td scope="row">{{ $order['closed'] }}</td>
    <td scope="row">{{ $order['profit'] }}</td>
    <td scope="row">{{ $order['stopLoss'] }}</td>
    <td scope="row">{{ $order['takeProfit'] }}</td>    
</tr>