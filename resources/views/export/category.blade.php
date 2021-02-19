<div class="card">
    <div class='card-header'>
        <h4>Category Totals from {{$from}} to {{$to}} </h4>
    </div>
    <div class="card card-body">
        <table>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{$result[0]}}</td>

                    @for ($i=1; $i <= 6;$i++)
                        @if ($i  < count($result))
                            <td class="text-xl-left">{{$result[$i][0]}}</td>
                            <td class="text-xl-right">{{$result[$i][1]}}</td>
                        @else
                            <td></td>
                            <td></td>
                        @endif

                    @endfor
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
